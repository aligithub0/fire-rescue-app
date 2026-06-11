@echo off
REM Launch the Fire Rescue AI Severity Prediction service.
REM Double-click this file (or run it) whenever you start the app.

cd /d "%~dp0"
call venv\Scripts\activate.bat
echo Starting AI Severity service on http://127.0.0.1:5000 ...
python app.py
pause
