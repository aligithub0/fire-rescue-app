"""
CV Severity Engine
------------------
Estimates fire severity (Low / Medium / High) from an image using classical
computer vision -- no training data required. It measures:

  * fire_coverage  : fraction of the image that looks like flame
                     (bright red / orange / yellow pixels)
  * smoke_coverage : fraction that looks like smoke (low-saturation grey haze)
  * flame_intensity: mean brightness of the detected flame pixels

These are combined into a severity score and mapped to Low/Medium/High.
This engine works on day one and also serves as the fallback for the trained
CNN model added in a later phase.

All thresholds are gathered at the top so they are easy to tune.
"""

import cv2
import numpy as np
from PIL import Image

# --- Tunable thresholds -----------------------------------------------------
#
# Severity is driven mainly by FLAME coverage, which is a reliable signal.
# Smoke (grey/low-saturation pixels) is noisy with classical CV -- grey walls,
# sky and concrete look the same -- so it is only used as a weak secondary
# booster, never on its own to claim a serious fire.

HIGH_FIRE_RATIO = 0.15     # >=15% flame pixels -> High
MEDIUM_FIRE_RATIO = 0.04   # >=4% flame pixels  -> at least Medium
LOW_FIRE_RATIO = 0.004     # a small but real flame -> Low
HEAVY_SMOKE_RATIO = 0.40   # only counts as a co-factor alongside some flame

THREAT_BY_SEVERITY = {
    "Low": "Minor",
    "Medium": "Moderate",
    "High": "Severe",
    "None": "Negligible",
}


def _fire_mask(bgr):
    """Boolean mask of flame-coloured pixels (red/orange/yellow + bright)."""
    hsv = cv2.cvtColor(bgr, cv2.COLOR_BGR2HSV)
    h, s, v = hsv[:, :, 0], hsv[:, :, 1], hsv[:, :, 2]

    # Fire hue sits in the red->yellow band; require decent saturation+brightness.
    hue_ok = (h <= 35) | (h >= 160)          # OpenCV hue is 0-179; wrap red
    sat_ok = s >= 60
    val_ok = v >= 120
    hsv_fire = hue_ok & sat_ok & val_ok

    # RGB rule catches bright flames where R dominates G dominates B.
    b, g, r = bgr[:, :, 0].astype(int), bgr[:, :, 1].astype(int), bgr[:, :, 2].astype(int)
    rgb_fire = (r > 150) & (r >= g) & (g >= b)

    return hsv_fire & rgb_fire


def _smoke_mask(bgr):
    """Boolean mask of smoke-like pixels (greyish, low saturation, mid-bright)."""
    hsv = cv2.cvtColor(bgr, cv2.COLOR_BGR2HSV)
    s, v = hsv[:, :, 1], hsv[:, :, 2]
    return (s < 50) & (v > 80) & (v < 210)


def _guess_fire_type(fire_ratio, smoke_ratio, flame_intensity):
    """Best-effort, optional fire-type label."""
    if fire_ratio < 0.01 and smoke_ratio >= HEAVY_SMOKE_RATIO:
        return "Smouldering / smoke-heavy"
    if flame_intensity >= 200 and fire_ratio >= MEDIUM_FIRE_RATIO:
        return "Intense open flame"
    if fire_ratio >= MEDIUM_FIRE_RATIO:
        return "Active structural fire"
    return "General fire"


def analyze_image(bgr):
    """
    Run the CV severity analysis on a BGR image (numpy array from cv2).

    Returns a dict with severity, threat_level, fire_type, confidence and the
    underlying coverage measurements.
    """
    if bgr is None or bgr.size == 0:
        raise ValueError("Empty or unreadable image")

    # Downscale large images for speed; analysis is ratio-based so it's safe.
    h, w = bgr.shape[:2]
    max_side = 640
    if max(h, w) > max_side:
        scale = max_side / max(h, w)
        bgr = cv2.resize(bgr, (int(w * scale), int(h * scale)))

    total = bgr.shape[0] * bgr.shape[1]
    fire = _fire_mask(bgr)
    smoke = _smoke_mask(bgr)

    fire_ratio = float(fire.sum()) / total
    smoke_ratio = float(smoke.sum()) / total

    # Mean brightness of flame pixels (0 if none).
    gray = cv2.cvtColor(bgr, cv2.COLOR_BGR2GRAY)
    flame_intensity = float(gray[fire].mean()) if fire.any() else 0.0

    # --- Map to severity (flame-dominant) ---
    smoke_cofactor = smoke_ratio >= HEAVY_SMOKE_RATIO
    decided_by_smoke = False

    if fire_ratio >= HIGH_FIRE_RATIO or (
        fire_ratio >= MEDIUM_FIRE_RATIO and smoke_cofactor
    ):
        severity = "High"
    elif fire_ratio >= MEDIUM_FIRE_RATIO or (
        fire_ratio >= LOW_FIRE_RATIO and smoke_cofactor
    ):
        severity = "Medium"
    elif fire_ratio >= LOW_FIRE_RATIO:
        severity = "Low"
    elif smoke_cofactor:
        # Lots of "smoke" but no visible flame: could be a real smoky fire or
        # just a grey scene. Report Low and flag with low confidence for review.
        severity = "Low"
        decided_by_smoke = True
    else:
        severity = "None"

    # --- Confidence: driven by flame evidence; smoke-only is low-confidence. ---
    if decided_by_smoke:
        confidence = 0.45  # uncertain -> Control Center should eyeball it
    else:
        confidence = min(0.95, 0.55 + fire_ratio * 2.5)
    confidence = round(float(confidence), 2)

    return {
        "severity": severity,
        "threat_level": THREAT_BY_SEVERITY[severity],
        "fire_type": _guess_fire_type(fire_ratio, smoke_ratio, flame_intensity),
        "confidence": confidence,
        "fire_coverage": round(fire_ratio, 4),
        "smoke_coverage": round(smoke_ratio, 4),
        "flame_intensity": round(flame_intensity, 1),
        "engine": "cv",
    }


def _pillow_to_bgr(path_or_bytes):
    """Fallback decoder for images OpenCV can't read (odd PNG modes, etc.)."""
    img = Image.open(path_or_bytes).convert("RGB")
    rgb = np.array(img)
    return cv2.cvtColor(rgb, cv2.COLOR_RGB2BGR)


def analyze_path(path):
    """Convenience: load an image from disk and analyse it."""
    bgr = cv2.imread(path)
    if bgr is None:
        try:
            bgr = _pillow_to_bgr(path)
        except Exception:
            raise ValueError(f"Could not read image at: {path}")
    return analyze_image(bgr)


def analyze_bytes(data):
    """Analyse an image given as raw bytes (e.g. an uploaded file)."""
    arr = np.frombuffer(data, dtype=np.uint8)
    bgr = cv2.imdecode(arr, cv2.IMREAD_COLOR)
    if bgr is None:
        try:
            import io
            bgr = _pillow_to_bgr(io.BytesIO(data))
        except Exception:
            raise ValueError("Could not decode image bytes")
    return analyze_image(bgr)
