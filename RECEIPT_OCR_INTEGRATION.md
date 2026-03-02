# Receipt OCR & AI Integration Guide

Complete setup guide for integrating receipt OCR & AI categorization into LifeOps expense management.

## 📋 What's Implemented

### Features
✅ **Receipt Photo Capture** - Take photos of receipts directly in the app  
✅ **Tesseract OCR** - Extracts text from receipt images (French + English)  
✅ **Smart Categorization** - Keyword-based AI categorization  
✅ **Auto-fill Forms** - Automatically populates expense form fields:
  - Amount (montant)
  - Category (categorie) 
  - Date (date)
  - Payment Method (typePaiement)
  - Description (titre)

## 🚀 Quick Start (5 minutes)

### Step 1: Install Tesseract OCR

**Windows:**
- Download: https://github.com/UB-Mannheim/tesseract/wiki
- Run installer (default path: `C:\Program Files\Tesseract-OCR`)
- Or: `winget install UB-Mannheim.TesseractOCR`

**Linux (Ubuntu/Debian):**
```bash
sudo apt-get update
sudo apt-get install tesseract-ocr python3-pip
```

**macOS:**
```bash
brew install tesseract
```

### Step 2: Start Python Service

**Windows:**
```bash
cd python_service
start.bat
```

**Linux/macOS:**
```bash
cd python_service
chmod +x start.sh
./start.sh
```

You should see:
```
============================================================
Receipt OCR & AI Expense Categorization Service
============================================================
Service running on http://localhost:5000
```

### Step 3: Run Symfony Application

In another terminal:
```bash
cd /path/to/LifeOps
php -S localhost:8000 -t public
# OR
symfony server:start
```

### Step 4: Test It!

1. Navigate to: `http://localhost:8000/depense/new`
2. Click "📷 Prendre une photo" button
3. Select or take a receipt image
4. Watch the fields auto-populate! ✨

## 📁 Project Structure

```
LifeOps/
├── python_service/              ← Python Flask service
│   ├── app.py                   ← Main OCR service
│   ├── requirements.txt          ← Python dependencies
│   ├── README.md               ← Python service docs
│   ├── start.bat               ← Windows launcher
│   └── start.sh                ← Linux/macOS launcher
├── .env                         ← Environment config
├── src/
│   ├── Controller/Other/
│   │   ├── ReceiptOcrController.php  ← API endpoint
│   │   └── DepenseController.php     ← Expense management
│   ├── Entity/
│   │   └── Depense.php         ← Updated with receipt_image field
│   └── Form/
│       └── DepenseType.php     ← Updated with receipt input
├── migrations/
│   └── Version20260221120000.php ← DB migration
└── templates/
    └── other/finance/depense/
        └── new.html.twig       ← Added OCR UI + JavaScript
```

## 🔧 Configuration

### Environment Variables

File: `.env`
```dotenv
# Receipt OCR & AI Processing
PYTHON_SERVICE_URL=http://localhost:5000
```

### Symfony Routing

The API endpoint is auto-configured:
```php
// ReceiptOcrController.php
#[Route('/api')]
class ReceiptOcrController extends AbstractController
{
    #[Route('/depense/process-receipt', name: 'app_process_receipt', methods: ['POST'])]
    public function processReceipt(Request $request): JsonResponse
    {
        // Handles receipt processing
    }
}
```

### Database Schema

New field added to `depense` table:
```sql
ALTER TABLE depense ADD receipt_image VARCHAR(255) DEFAULT NULL;
```

Run migration:
```bash
php bin/console doctrine:migrations:migrate
```

## 📊 Data Flow

```
┌─────────────────────┐
│  User takes photo   │
│   of receipt        │
└──────────┬──────────┘
           │
           ↓
┌──────────────────────────────┐
│  JavaScript FormData          │
│  (file upload)               │
└──────────┬───────────────────┘
           │
           ↓
┌────────────────────────────────────────┐
│ Symfony Controller                     │
│ /api/depense/process-receipt           │
│ - Validates user                       │
│ - Uploads to Python service            │
└──────────┬─────────────────────────────┘
           │
           ↓
┌────────────────────────────────────────┐
│ Python Flask Service                   │
│ /api/process-receipt                   │
│ - Image enhancement                    │
│ - Tesseract OCR extraction             │
│ - Regex parsing (amount, date)         │
│ - Keyword categorization               │
│ - Payment method detection             │
└──────────┬─────────────────────────────┘
           │
           ↓
┌────────────────────────────────────────┐
│ JSON Response                          │
│ {                                      │
│   montant: 45.99,                      │
│   categorie: "Alimentation",           │
│   date: "2026-02-21",                  │
│   typePaiement: "CB",                  │
│   titre: "Carrefour Market"            │
│ }                                      │
└──────────┬─────────────────────────────┘
           │
           ↓
┌────────────────────────────────────────┐
│ JavaScript auto-fill                   │
│ - Sets form field values               │
│ - Shows receipt preview                │
│ - Shows success message                │
└────────────────────────────────────────┘
```

## 🎯 Supported Categories

The system automatically categorizes expenses into:

| Category | Keywords | Example |
|----------|----------|---------|
| 🍔 **Alimentation** | restaurant, courses, épicerie, café, pizza | Carrefour, Pizza Hut |
| 🚗 **Transport** | taxi, essence, bus, train, métro, parking | Shell, RATP, Uber |
| 🎬 **Loisirs** | cinéma, théâtre, musée, concert, jeux | Cinéma UGC, Spotify |
| 💊 **Santé** | pharmacie, médecin, hôpital, dentiste | Pharmacie, Hôpital |
| 🏠 **Logement** | loyer, électricité, eau, internet | EDF, Veolia |
| 📚 **Éducation** | école, université, cours, formation | ESPRIT, Coursera |
| 📦 **Autre** | miscellaneous | Everything else |

## 🧪 Testing

### Test with Postman

1. **Health Check**
   ```
   GET http://localhost:5000/health
   ```

2. **Process Receipt**
   ```
   POST http://localhost:5000/api/process-receipt
   Form Data: receipt=<image_file>
   ```

3. **Debug OCR Output**
   ```
   POST http://localhost:5000/api/debug
   Form Data: receipt=<image_file>
   ```

### Test API from Command Line

```bash
# Process a receipt
curl -X POST -F "receipt=@receipt.jpg" \
  http://localhost:5000/api/process-receipt

# Check service health
curl http://localhost:5000/health
```

## 🔐 Security Features

✅ **File Validation**
- Allowed types: PNG, JPG, JPEG, GIF, BMP
- Max size: 16MB
- Secure filename handling

✅ **User Authentication**
- Only authenticated users can upload receipts
- Receipts associated with current user

✅ **Cleanup**
- Temporary files deleted after processing
- No persistent image storage on server

## ⚠️ Troubleshooting

### Python Service Won't Start

**Error:** `pytesseract.TesseractNotFoundError`

**Solution:**
```bash
# Windows
set PATH=%PATH%;C:\Program Files\Tesseract-OCR

# Or edit app.py:
import pytesseract
pytesseract.pytesseract.pytesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
```

### Connection Refused

**Error:** `Connection refused on localhost:5000`

**Solution:**
- Ensure Python service is running in separate terminal
- Check `.env` - verify `PYTHON_SERVICE_URL` is correct
- Check firewall isn't blocking port 5000

### Empty OCR Output

**Causes:**
- Receipt image is blurry or low quality
- Wrong language set in OCR
- Image contrast too low

**Solutions:**
- Use clearer photo under good lighting
- Check service logs for errors
- Use `/api/debug` endpoint to inspect raw output

### Form Fields Don't Auto-fill

**Check:**
1. Browser console for JavaScript errors (F12 → Console)
2. Network tab to verify API calls succeed
3. Python service logs for processing errors

## 🚀 Production Deployment

### Docker (Recommended)

Create `docker-compose.yml`:
```yaml
version: '3'
services:
  symfony-app:
    image: php:8.2-fpm
    # ... Symfony config
  
  ocr-service:
    build: ./python_service
    ports:
      - "5000:5000"
    environment:
      FLASK_ENV: production
```

### Environment Setup

For production, update `.env.prod`:
```dotenv
PYTHON_SERVICE_URL=https://ocr-service.yourdomain.com
```

### Rate Limiting

Add to Python service:
```python
from flask_limiter import Limiter
limiter = Limiter(app, key_func=lambda: request.remote_addr)

@app.route('/api/process-receipt', methods=['POST'])
@limiter.limit("10 per minute")
def process_receipt():
    # ...
```

## 📈 Performance Tips

1. **Image Quality Matters**
   - 1000x800px minimum
   - Good lighting
   - Straight angle (not tilted)

2. **OCR Accuracy**
   - Clearer receipt = better extraction
   - Tesseract handles both typed and handwritten
   - French + English supported

3. **Server Response Time**
   - ~2-5 seconds typical
   - Depends on image size and complexity

## 🎓 Learning Resources

- [Tesseract OCR Documentation](https://github.com/tesseract-ocr/tesseract)
- [Flask Documentation](https://flask.palletsprojects.com/)
- [Symfony HTTP Client](https://symfony.com/doc/current/http_client.html)
- [JavaScript Fetch API](https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API)

## 📞 Support

For issues:
1. Check Python service logs in terminal
2. Check browser console (F12)
3. Test with `/api/debug` endpoint
4. Verify Tesseract installation

## 🎉 What's Next?

### Planned Enhancements
- [ ] FinBERT integration for NLP categorization
- [ ] Receipt image storage with database
- [ ] Item-level expense parsing
- [ ] Batch receipt processing
- [ ] Multi-language support
- [ ] Mobile app integration
- [ ] Receipt history and search
- [ ] Expense analytics dashboard

---

**Last Updated:** February 21, 2026  
**Version:** 1.0  
**Status:** Production Ready ✅
