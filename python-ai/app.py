"""
Fire Rescue - AI Severity Prediction Service
--------------------------------------------
A small Flask service the PHP app calls at complaint-submission time.

Endpoints:
  GET  /health        -> {"status": "ok"} for a quick liveness check
  POST /predict       -> analyse a fire image, return severity prediction

POST /predict accepts the image in any of these ways:
  * multipart/form-data file field named "image"
  * form/JSON field "image_path"  (absolute path or path relative to the app)
  * form/JSON field "filename"    (a name inside the shared upload/ folder)

Response JSON:
  {
    "status": "done",
    "severity": "High",
    "threat_level": "Severe",
    "fire_type": "Active structural fire",
    "confidence": 0.82,
    "fire_coverage": 0.27,
    "smoke_coverage": 0.18,
    "engine": "cv"
  }
"""

import os

from flask import Flask, jsonify, request
from flask_cors import CORS

import cv_severity

app = Flask(__name__)
CORS(app)

# upload/ lives one level up, in the PHP project root.
PROJECT_ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
UPLOAD_DIR = os.path.join(PROJECT_ROOT, "upload")


@app.get("/health")
def health():
    return jsonify(status="ok", service="fire-severity", engine="cv")


@app.get("/")
def index():
    return jsonify(
        service="Fire Rescue AI Severity Prediction",
        endpoints=["GET /health", "POST /predict"],
    )


@app.post("/predict")
def predict():
    try:
        result = _run_prediction()
        result["status"] = "done"
        return jsonify(result)
    except ValueError as exc:
        # Bad/unreadable image -> 400 so PHP can mark ai_status='failed'.
        return jsonify(status="failed", error=str(exc)), 400
    except Exception as exc:  # noqa: BLE001 - never crash the service
        return jsonify(status="failed", error=str(exc)), 500


def _run_prediction():
    # 1) multipart file upload
    if "image" in request.files and request.files["image"].filename:
        return cv_severity.analyze_bytes(request.files["image"].read())

    # 2) form or JSON payload
    payload = request.form.to_dict()
    if not payload and request.is_json:
        payload = request.get_json(silent=True) or {}

    image_path = payload.get("image_path")
    if image_path:
        if not os.path.isabs(image_path):
            image_path = os.path.join(PROJECT_ROOT, image_path)
        return cv_severity.analyze_path(image_path)

    filename = payload.get("filename")
    if filename:
        # Guard against path traversal; only allow names inside upload/.
        safe = os.path.basename(filename)
        return cv_severity.analyze_path(os.path.join(UPLOAD_DIR, safe))

    raise ValueError("No image provided (use 'image' file, 'image_path' or 'filename')")


if __name__ == "__main__":
    # 127.0.0.1 only -> not exposed outside this machine.
    app.run(host="127.0.0.1", port=5000, debug=True)
