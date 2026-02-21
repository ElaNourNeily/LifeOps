# Receipt OCR & AI Expense Categorization Service

A Flask-based REST API service that extracts expense data from receipt images using Tesseract OCR and intelligent keyword-based categorization.

## Features

- **Tesseract OCR**: Extracts text from receipt images (supports French + English)
- **Smart Expense Categorization**: Keyword-based categorization for:
  - Alimentation (Food)
  - Transport
  - Loisirs (Entertainment)
  - Santé (Health)
  - Logement (Housing)
  - Éducation (Education)
  - Autre (Other)
- **Receipt Parsing**: Automatically extracts:
  - Amount/Total
  - Date
  - Payment method (Card, Cash, Transfer, Check)
  - Merchant name
- **Image Enhancement**: Improves OCR accuracy through contrast/sharpness enhancement

## Prerequisites

### Windows

1. **Install Python 3.8+**
   ```bash
   # Download from https://www.python.org/
   # OR use winget
   winget install Python.Python.3.11
   ```

2. **Install Tesseract OCR**
   ```bash
   # Method 1: Using installer
   #   Download: https://github.com/UB-Mannheim/tesseract/wiki
   #   Install to: C:\Program Files\Tesseract-OCR
   
   # Method 2: Using winget
   winget install UB-Mannheim.TesseractOCR
   ```

3. **Verify Installation**
   ```bash
   tesseract --version
   python --version
   ```

### Linux (Ubuntu/Debian)

```bash
sudo apt-get update
sudo apt-get install tesseract-ocr libtesseract-dev
sudo apt-get install python3-pip python3-venv
```

### macOS

```bash
brew install tesseract python@3.11
```

## Installation

### 1. Navigate to Python Service Directory

```bash
cd python_service
```

### 2. Create Virtual Environment (Recommended)

**Windows:**
```bash
python -m venv venv
venv\Scripts\activate
```

**Linux/macOS:**
```bash
python3 -m venv venv
source venv/bin/activate
```

### 3. Install Python Dependencies

```bash
pip install -r requirements.txt
```

### 4. Configure Tesseract Path (Windows Only)

If Tesseract is not in PATH, edit `app.py` and add after imports:

```python
import pytesseract
pytesseract.pytesseract.pytesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
```

## Running the Service

```bash
python app.py
```

You should see:
```
============================================================
Receipt OCR & AI Expense Categorization Service
============================================================
Service running on http://localhost:5000
Endpoints:
  POST /api/process-receipt - Process receipt image
  GET  /health             - Health check
============================================================
```

## API Endpoints

### Health Check

**Request:**
```bash
curl http://localhost:5000/health
```

**Response:**
```json
{
  "status": "ok",
  "service": "Receipt OCR API"
}
```

### Process Receipt

**Request:**
```bash
curl -X POST -F "receipt=@receipt.jpg" http://localhost:5000/api/process-receipt
```

**Response:**
```json
{
  "success": true,
  "montant": 45.99,
  "categorie": "Alimentation",
  "date": "2026-02-21",
  "typePaiement": "CB",
  "titre": "Carrefour Market",
  "raw_text": "CARREFOUR MARKET 45 RUE DE LA PAIX..."
}
```

### Debug OCR (Raw Output)

**Request:**
```bash
curl -X POST -F "receipt=@receipt.jpg" http://localhost:5000/api/debug
```

## Response Fields

| Field | Type | Description |
|-------|------|-------------|
| `success` | boolean | Whether processing was successful |
| `montant` | float | Extracted amount in EUR |
| `categorie` | string | Categorized expense type |
| `date` | string | Receipt date (YYYY-MM-DD format) |
| `typePaiement` | string | Payment method detected |
| `titre` | string | Merchant/store name |
| `raw_text` | string | First 300 characters of OCR output |
| `error` | string | Error message if unsuccessful |

## Category Mapping

```python
'alimentation'   → Food, restaurants, groceries
'transport'      → Taxi, gas, public transit, parking
'loisirs'        → Entertainment, cinema, concerts
'sante'          → Pharmacy, medical, health services
'logement'       → Rent, utilities, housing
'education'      → School, courses, learning
'autre'          → Miscellaneous
```

## Testing with Postman

1. Open Postman
2. Create new POST request to `http://localhost:5000/api/process-receipt`
3. Go to **Body** tab → **form-data**
4. Key: `receipt` | Value: Select image file
5. Send

## Troubleshooting

### Issue: "pytesseract.TesseractNotFoundError"

**Solution:** Install Tesseract system package and ensure it's in PATH

```bash
# Windows
set PYTESSERACT_PATH=C:\Program Files\Tesseract-OCR\tesseract.exe

# Linux
sudo apt-get install tesseract-ocr

# macOS
brew install tesseract
```

### Issue: "No module named 'flask'"

**Solution:** Ensure virtual environment is activated and install requirements

```bash
pip install -r requirements.txt
```

### Issue: Empty OCR output

**Try:** 
- Use clearer/higher resolution receipt image
- Ensure proper lighting when taking photo
- Supported formats: PNG, JPG, JPEG, GIF, BMP

## Integration with Symfony

See the Symfony controller at: `src/Controller/Other/ReceiptOcrController.php`

The service is called by JavaScript in the expense form template:
- File: `templates/other/finance/depense/new.html.twig`
- AJAX endpoint: `/api/depense/process-receipt`
- Auto-fills: titre, montant, categorie, date, typePaiement

## Architecture

```
User takes receipt photo
         ↓
   JavaScript FormData
         ↓
Symfony /api/depense/process-receipt
         ↓
   HttpClient POST
         ↓
Python Flask /api/process-receipt
    (Tesseract OCR)
    (Keyword Matching)
         ↓
JSON Response
         ↓
JavaScript auto-fills form
```

## Performance Tips

1. **Image Quality**: Clearer images = better OCR accuracy
2. **Image Size**: 1000x800px minimum recommended
3. **Language**: French + English support included
4. **Batch Processing**: Service handles one receipt at a time

## Security Notes

- ✅ Uploads stored in `/tmp/receipts`
- ✅ Files automatically deleted after processing
- ✅ Max file size: 16MB
- ✅ Allowed types: PNG, JPG, JPEG, GIF, BMP
- ⚠️ For production: Add authentication and rate limiting

## Future Enhancements

- [ ] FinBERT NLP integration for better categorization
- [ ] Receipt image storage with database references
- [ ] Batch processing API
- [ ] Multi-language support expansion
- [ ] Docker containerization
- [ ] API rate limiting and authentication
- [ ] Receipt item-level parsing (for itemized expenses)

## Support

For issues or questions:
1. Check logs in console output
2. Use `/api/debug` endpoint to inspect raw OCR
3. Verify Tesseract installation
4. Check file permissions on `/tmp/receipts`
