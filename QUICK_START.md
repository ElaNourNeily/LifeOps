# 🚀 Quick Start Checklist - Receipt OCR Implementation

## ⏱️ Time Required: 15-20 minutes

### ✅ PRE-REQUISITES (Install First)

#### Windows
- [ ] Python 3.8+ installed
- [ ] Tesseract OCR installed (Download from: https://github.com/UB-Mannheim/tesseract/wiki)
- [ ] Command line access (PowerShell or CMD)

#### Linux (Ubuntu/Debian)
- [ ] Run: `sudo apt-get update && sudo apt-get install tesseract-ocr python3-pip`

#### macOS
- [ ] Run: `brew install tesseract`

### 🔧 STEP 1: Setup Python Service (5 min)

**Navigate to Python Service:**
```bash
cd python_service
```

**Windows:**
```bash
start.bat
```y

**Linux/macOS:**
```bash
chmod +x start.sh
./start.sh
```

**Verify it's running:**
- Look for: `Service running on http://localhost:5000`
- Open browser: http://localhost:5000/health
- Should see: `{"status": "ok", "service": "Receipt OCR API"}`

✅ **KEEP THIS TERMINAL OPEN** (don't close)

---

### 🗄️ STEP 2: Setup Database Migration (3 min)

**In a NEW terminal, ensure you're in the LifeOps root:**

```bash
php bin/console doctrine:migrations:migrate
```

**Expected output:**
```
Migrating up to Version20260221120000
 > migrating Version20260221120000
 > migrated Version20260221120000
```

✅ Done! The `receipt_image` field is now in your database

---

### 🚀 STEP 3: Start Symfony Application (2 min)

**In another NEW terminal:**

```bash
# Option 1: Using PHP built-in server
php -S localhost:8000 -t public

# Option 2: Using Symfony CLI (if installed)
symfony server:start
```

**You should see:**
```
Listening on http://localhost:8000
```

✅ You now have 3 terminals running:
1. Python OCR service (port 5000)
2. Symfony app (port 8000)
3. Terminal for testing (optional)

---

### 🧪 STEP 4: Test the Integration (5 min)

#### Method 1: Browser Test (Easiest) ✅

1. Open browser: **http://localhost:8000**
2. Log in to your LifeOps account
3. Navigate to: **"Ajouter une dépense"** or **"Nouvelle Dépense"**
4. Click button: **"� Charger un reçu"**
5. Select a receipt image from your computer
6. **Watch it auto-populate the form!** ✨

#### Method 2: Postman Test (Advanced)

1. Open Postman
2. Create POST request to: `http://localhost:8000/api/depense/process-receipt`
3. Headers: `Authorization: Bearer <your-token>`
4. Body → form-data:
   - Key: `receipt`
   - Value: select your receipt image file
5. Send!
6. Check response JSON

#### Method 3: Command Line Test

```bash
curl -X POST \
  -F "receipt=@path/to/receipt.jpg" \
  http://localhost:5000/api/process-receipt
```

---

### ✨ EXPECTED BEHAVIOR

**When you upload a receipt photo, you should see:**

✅ Loading spinner appears
✅ "Traitement en cours..." message
✅ Form fields auto-fill:
   - **Titre** → "Carrefour Market" (merchant name)
   - **Montant** → "45.99" (amount)
   - **Catégorie** → "Nourriture" (category)
   - **Date** → "2026-02-21" (receipt date)
   - **Type Paiement** → "CB" (payment method)
✅ Receipt preview image displayed
✅ Success message: "✅ Reçu traité avec succès!"
✅ You can now review/edit the auto-filled fields
✅ Click "Ajouter la dépense" to save

---

### 📊 TROUBLESHOOTING

**Problem:** Python service won't start
```
Error: pytesseract.TesseractNotFoundError
```
**Solution:**
- Ensure Tesseract OCR is installed
- Windows: Add to PATH or edit `python_service/app.py`:
  ```python
  pytesseract.pytesseract.pytesseract_cmd = r'C:\Program Files\Tesseract-OCR\tesseract.exe'
  ```

**Problem:** "Connection refused" on localhost:5000
```
Error: [Errno 111] Connection refused
```
**Solution:**
- Ensure Python terminal is running with `python app.py`
- Check port 5000 isn't blocked by firewall

**Problem:** Form fields don't populate
**Solution:**
- Open F12 → Network tab → check API request
- Open Console tab → check for JavaScript errors
- Verify Python service is running: http://localhost:5000/health

**Problem:** OCR returns empty text
**Solution:**
- Use a clearer receipt image
- Ensure good lighting
- Try different image formats (JPG, PNG)
- Use `/api/debug` endpoint to see raw OCR output

---

### 📁 PROJECT STRUCTURE

Files you just created/modified:
```
LifeOps/
├── .env                                    ← Added PYTHON_SERVICE_URL
├── RECEIPT_OCR_INTEGRATION.md              ← Full integration guide
├── IMPLEMENTATION_SUMMARY.md                ← This implementation
├── python_service/                          ← NEW DIRECTORY
│   ├── app.py                             ← OCR service code
│   ├── requirements.txt                    ← Python dependencies
│   ├── README.md                          ← Service documentation
│   ├── start.bat                          ← Windows launcher
│   └── start.sh                           ← Linux/Mac launcher
├── src/
│   ├── Controller/Other/
│   │   ├── ReceiptOcrController.php       ← NEW API endpoint
│   │   └── DepenseController.php          ← (unchanged)
│   ├── Entity/
│   │   └── Depense.php                    ← Added receipt_image field
│   └── Form/
│       └── DepenseType.php                ← Added receiptImage input
├── migrations/
│   └── Version20260221120000.php           ← NEW database migration
└── templates/
    └── other/finance/depense/
        └── new.html.twig                 ← Added OCR UI + JavaScript
```

---

### 🎯 WHAT'S HAPPENING UNDER THE HOOD

```
You upload receipt photo
           ↓
Browser sends to Symfony API
           ↓
Symfony forwards to Python service on port 5000
           ↓
Python runs Tesseract OCR on the image
           ↓
Extracts:
  - Text from receipt
  - Amount (with regex)
  - Date (with date parsing)
  - Payment method (keyword detection)
  - Merchant name (first line of receipt)
  - Category (keyword scoring)
           ↓
Returns JSON to browser
           ↓
JavaScript auto-fills the form
           ↓
You review and submit
```

---

### 📚 FULL DOCUMENTATION

For detailed information, read:
- **Setup & Installation:** `python_service/README.md`
- **Integration Details:** `RECEIPT_OCR_INTEGRATION.md`
- **Implementation Summary:** `IMPLEMENTATION_SUMMARY.md`

---

### 🎉 YOU'RE ALL SET!

### Success Indicators ✅

- [ ] Python service running on localhost:5000
- [ ] Symfony app running on localhost:8000
- [ ] Can navigate to expense form
- [ ] Can click "� Charger un reçu"
- [ ] Can select a receipt image
- [ ] Form fields auto-populate
- [ ] Can submit the form

**If all checkboxes are ✅ - CONGRATULATIONS! The integration is working!**

---

### 📞 NEED HELP?

1. **Check browser console:** F12 → Console tab
2. **Check Python logs:** Look at terminal running Python service
3. **Test API directly:** `curl http://localhost:5000/health`
4. **Check database:** Verify migration ran successfully
5. **Verify .env:** Check `PYTHON_SERVICE_URL=http://localhost:5000`

---

### 🚀 NEXT STEPS (Optional Enhancements)

- [ ] Configure better NLP (FinBERT integration)
- [ ] Store receipt images in cloud storage
- [ ] Add batch receipt processing
- [ ] Mobile app integration
- [ ] Expense analytics dashboard
- [ ] Receipt search functionality
- [ ] Multi-language support expansion

---

**Ready to test?** Go to `http://localhost:8000/depense/new` and start uploading receipts! �

**Last Updated:** February 21, 2026  
**Status:** ✅ Production Ready
