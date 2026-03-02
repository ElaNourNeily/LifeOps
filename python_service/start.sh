#!/bin/bash
# Receipt OCR Service Startup Script for Linux/macOS

echo ""
echo "============================================================"
echo "  Receipt OCR & AI Expense Categorization Service"
echo "  Starting Python Flask Service..."
echo "============================================================"
echo ""

# Check if Python is installed
if ! command -v python3 &> /dev/null; then
    echo "ERROR: Python3 is not installed"
    echo "Install with: sudo apt-get install python3-pip python3-venv"
    exit 1
fi

# Check if Tesseract is installed
if ! command -v tesseract &> /dev/null; then
    echo "WARNING: Tesseract OCR may not be installed"
    echo "Install with:"
    echo "  Ubuntu/Debian: sudo apt-get install tesseract-ocr"
    echo "  macOS: brew install tesseract"
    echo ""
fi

# Check if venv exists, if not create it
if [ ! -d "venv" ]; then
    echo "Creating virtual environment..."
    python3 -m venv venv
fi

# Activate virtual environment
source venv/bin/activate

# Install/upgrade requirements
echo "Installing dependencies..."
pip install -q -r requirements.txt

# Run Flask app
echo ""
echo "Starting service on http://localhost:5000"
echo ""
python app.py
