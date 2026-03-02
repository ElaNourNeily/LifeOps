@echo off
REM Receipt OCR Service Startup Script for Windows

echo.
echo ============================================================
echo   Receipt OCR ^& AI Expense Categorization Service
echo   Starting Python Flask Service...
echo ============================================================
echo.

REM Check if Python is installed
python --version >nul 2>&1
if errorlevel 1 (
    echo ERROR: Python is not installed or not in PATH
    echo Please install Python from https://www.python.org/
    pause
    exit /b 1
)

REM Check if Tesseract is installed
tesseract --version >nul 2>&1
if errorlevel 1 (
    echo WARNING: Tesseract OCR may not be installed
    echo Download from: https://github.com/UB-Mannheim/tesseract/wiki
    echo.
)

REM Check if venv exists, if not create it
if not exist "venv\" (
    echo Creating virtual environment...
    python -m venv venv
)

REM Activate virtual environment
call venv\Scripts\activate.bat

REM Install/upgrade requirements
echo Installing dependencies...
pip install -q -r requirements.txt

REM Run Flask app
echo.
echo Starting service on http://localhost:5000
echo.
python app.py

pause
