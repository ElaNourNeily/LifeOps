#!/usr/bin/env python3
"""
Receipt OCR & AI Expense Categorization Service
Uses Tesseract OCR for text extraction and FinBERT for intelligent categorization
"""

from flask import Flask, request, jsonify
from flask_cors import CORS
from PIL import Image, ImageEnhance
import pytesseract
import os
import re
from datetime import datetime
import traceback
from werkzeug.utils import secure_filename
import logging
import shutil
import time

# Setup logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

# Set tesseract path to workspace executable
workspace_root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
tesseract_exe = os.path.join(workspace_root, 'tesseract.exe')
if not os.path.exists(tesseract_exe):
    tesseract_exe = os.path.join(workspace_root, 'tesseract')

if os.path.exists(tesseract_exe):
    pytesseract.pytesseract.tesseract_cmd = tesseract_exe
    logger.info(f'Tesseract found at: {tesseract_exe}')
else:
    # Try system PATH
    system_tesseract = shutil.which('tesseract')
    if system_tesseract:
        pytesseract.pytesseract.tesseract_cmd = system_tesseract
        logger.info(f"Tesseract found in PATH: {system_tesseract}")
    else:
        logger.warning("Tesseract not found. OCR will fail.")

app = Flask(__name__)
CORS(app)

# Configuration
UPLOAD_FOLDER = '/tmp/receipts'
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif', 'bmp', 'jfif', 'jif', 'heic', 'heif'}
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024  # 16MB max
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

# Create upload folder if not exists
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

# Define expense categories in French
EXPENSE_CATEGORIES = {
    'alimentation': [
        'restaurant', 'courses', 'épicerie', 'boulangerie', 'café', 'pizza', 
        'burger', 'boulangerie', 'supermarché', 'carrefour', 'auchan', 'marché',
        'food', 'eat', 'lunch', 'dinner', 'breakfast', 'snack', 'fast food', 'starbucks',
        'monoprix', 'lidl', 'aldi', 'intermarché', 'leclerc', 'u express', 'franprix'
    ],
    'transport': [
        'taxi', 'uber', 'essence', 'carburant', 'bus', 'train', 'métro', 'parking',
        'transport', 'ratp', 'sncf', 'carte rechargeable', 'autoroute',
        'gas', 'fuel', 'ride', 'transit', 'ticket de bus', 'ticket de métro', 'shell', 'totalenergies', 'gare'
    ],
    'loisirs': [
        'cinéma', 'théâtre', 'musée', 'parc', 'jeu', 'livre', 'billets', 'concert',
        'entertainment', 'sport', 'games', 'film', 'ticket', 'musique', 'fnac', 'culture', 'netflix', 'spotify'
    ],
    'sante': [
        'pharmacie', 'médecin', 'hôpital', 'docteur', 'dentiste', 'santé', 'médecin',
        'pharmacy', 'doctor', 'health', 'medical', 'clinic', 'médicament'
    ],
    'logement': [
        'loyer', 'électricité', 'eau', 'gaz', 'internet', 'assurance', 'électricité',
        'utilities', 'electricity', 'edf', 'gdf', 'rent', 'home', 'loyers', 'travaux', 'bricolage'
    ],
    'education': [
        'école', 'université', 'cours', 'formation', 'livre', 'scolaire', 'etudiant',
        'school', 'university', 'course', 'learning', 'book', 'education', 'frais'
    ],
    'autre': [
        'autre', 'miscellaneous', 'divers', 'vêtements', 'habillement', 'zara', 
        'pull & bear', 'bershka', 'h&m', 'hm', 'clothing', 'fashion', 'shoes', 'chaussures',
        'stradivarius', 'massimo dutti', 'oysho', 'zara home', 'uturque', 'lefties',
        'nike', 'adidas', 'puma', 'levis', 'lacoste', 'celio', 'kiabi', 'decathlon',
        'luxolor', 'retail', 'uib'
    ]
}

# DISABLE ZERO-SHOT TO PREVENT TIMEOUTS ON CPU
ZERO_SHOT_AVAILABLE = False

def allowed_file(filename):
    """Check if file extension is allowed"""
    if not filename or '.' not in filename:
        return False
    ext = filename.rsplit('.', 1)[1].lower()
    is_allowed = ext in ALLOWED_EXTENSIONS
    if not is_allowed:
        logger.warning(f"Extension '{ext}' rejected for filename '{filename}'")
    return is_allowed

def enhance_image(image_path):
    """Enhance image for better OCR results"""
    try:
        img = Image.open(image_path)
        
        # Convert to RGB if necessary
        if img.mode != 'RGB':
            img = img.convert('RGB')
        
        # Enhance contrast
        enhancer = ImageEnhance.Contrast(img)
        img = enhancer.enhance(2)
        
        # Enhance sharpness
        enhancer = ImageEnhance.Sharpness(img)
        img = enhancer.enhance(2)
        
        # Downsize to 1200px max (Optimal for speed on CPU/Windows)
        if img.width > 1200 or img.height > 1200:
            img.thumbnail((1200, 1200), Image.Resampling.LANCZOS)
            logger.info(f"Image optimized to {img.size} for MAX speed")
        
        return img
    except Exception as e:
        logger.error(f"Error enhancing image: {str(e)}")
        return Image.open(image_path)

def extract_text_from_receipt(image_path):
    """Extract text from receipt image using Tesseract OCR"""
    try:
        img = enhance_image(image_path)
        
        # Perform OCR with optimized configuration for speed
        # --oem 1: Neural nets LSTM only (Faster)
        # --psm 3: Fully automatic page segmentation
        config = '--oem 1 --psm 3'
        text = pytesseract.image_to_string(img, config=config, lang='eng')
        
        if not text or text.strip() == '':
            logger.warning("OCR returned empty text")
            return ""
        
        logger.info(f"OCR extracted {len(text)} characters")
        return text
    except Exception as e:
        logger.error(f"Error extracting text: {str(e)}")
        return f"Error: {str(e)}"

def extract_amount(text):
    """Extract monetary amount from receipt text"""
    if not text:
        return None
    
    # Pre-clean text: replace comma with dot for regex consistency in some parts
    # but be careful not to break dates
    text_clean = text.replace(',', '.')
    
    patterns = [
        # Look for labels first (Highest confidence)
        r'montant\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'achat\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'total\s+ttc\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'total\s+à\s+payer\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'montant\s+total\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'net\s+à\s+payer\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'total\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'sum\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        r'à\s+payer\s*:?\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        # Standalone amounts with currency symbols
        r'([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)\s*[€£$]',
        r'[€£$]\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
        # Standalone amounts with currency codes (EUR, TND, DT)
        r'([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)\s*(?:eur|tnd|dt|dinars)',
        r'(?:eur|tnd|dt|dinars)\s*([\d\s]*[\d]+(?:[\.,][\d]{1,3})?)',
    ]
    
    # Try with original text first for complex matches
    text_lower = text.lower()
    for pattern in patterns:
        match = re.search(pattern, text_lower)
        if match:
            try:
                # Clean amount: remove spaces, replace comma with dot
                amount_str = match.group(1).replace(' ', '').replace(',', '.')
                amount = float(amount_str)
                if 0.1 <= amount < 10000:  # Reasonable range
                    return amount
            except Exception:
                continue
    
    # Fallback to finding the largest number with 2 or 3 decimals
    # But ONLY if it's not followed by a date pattern suffix (e.g. 13.02.26)
    all_amounts = re.findall(r'\b\d+[\., ]\d{2,3}(?!\.(?:\d{2}|\d{4}))\b', text.replace(',', '.'))
    if all_amounts:
        try:
            processed_amounts = [float(a.replace(' ', '')) for a in all_amounts]
            # Filter reasonable amounts
            processed_amounts = [a for a in processed_amounts if 0.1 <= a < 5000]
            if processed_amounts:
                return max(processed_amounts)
        except Exception:
            pass
            
    return None

def extract_date(text):
    """Extract date and time from receipt"""
    if not text:
        return datetime.now().strftime('%Y-%m-%dT%H:%M')
    
    # Combined date and optional time pattern - Prioritize YYYY format to avoid partial matches
    # Added dot separator support
    date_patterns = [
        r'\b(\d{4})[./-](\d{1,2})[./-](\d{1,2})(?:\s+(\d{1,2}):(\d{1,2}))?\b',      # YYYY-MM-DD
        r'\b(\d{1,2})[./-](\d{1,2})[./-](\d{4})(?:\s+(\d{1,2}):(\d{1,2}))?\b',      # DD/MM/YYYY
        r'\b(\d{1,2})[./-](\d{1,2})[./-](\d{2})(?:\s+(\d{1,2}):(\d{1,2}))?\b',      # DD/MM/YY
        r'\b(\d{2})[./-](\d{1,2})[./-](\d{1,2})(?:\s+(\d{1,2}):(\d{1,2}))?\b',      # YY-MM-DD
    ]
    
    for idx, pattern in enumerate(date_patterns):
        matches = re.finditer(pattern, text)
        for match in matches:
            try:
                groups = match.groups()
                if idx == 0:  # YYYY-MM-DD
                    year, month, day, hour, minute = groups
                elif idx == 1: # DD/MM/YYYY
                    day, month, year, hour, minute = groups
                elif idx == 2: # DD/MM/YY
                    day, month, year, hour, minute = groups
                else: # YY-MM-DD
                    year, month, day, hour, minute = groups
                
                # Handle 2-digit year
                if len(year) == 2:
                    current_year = datetime.now().year
                    century = (current_year // 100) * 100
                    year = str(century + int(year))
                
                # Default time if not found
                if not hour or not minute:
                    hour, minute = "12", "00"
                
                # Validate month and day
                month_int = int(month)
                day_int = int(day)
                if 1 <= month_int <= 12 and 1 <= day_int <= 31:
                    return f"{year}-{month.zfill(2)}-{day.zfill(2)}T{hour.zfill(2)}:{minute.zfill(2)}"
            except (ValueError, AttributeError):
                continue
    
    return datetime.now().strftime('%Y-%m-%dT%H:%M')

def extract_payment_method(text):
    """Detect payment method from receipt"""
    if not text:
        return 'CB'
    
    payment_keywords = {
        'CB': ['carte', 'credit', 'visa', 'mastercard', 'cb', 'paypal', 'amex'],
        'Espèces': ['especes', 'cash', 'comptant', 'espece', 'liquide'],
        'Chèque': ['cheque', 'check', 'chèque'],
        'Virement': ['virement', 'transfer', 'virement', 'prelevement', 'prélèvement'],
    }
    
    text_lower = text.lower()
    for method, keywords in payment_keywords.items():
        for keyword in keywords:
            if keyword in text_lower:
                logger.info(f"Payment method detected: {method}")
                return method
    
    return 'CB'  # Default to card

def categorize_expense(text):
    """Categorize expense using keyword matching"""
    if not text:
        return 'Autre'
    
    text_lower = text.lower()
    
    # Score each category based on keyword matches
    category_scores = {}
    for category, keywords in EXPENSE_CATEGORIES.items():
        score = 0
        for keyword in keywords:
            if keyword.lower() in text_lower:
                score += 1
        if score > 0:
            category_scores[category] = score
    
    # Return category with highest score
    if category_scores:
        best_category = max(category_scores, key=category_scores.get)
        logger.info(f"Expense categorized as: {best_category}")
        return best_category.capitalize()
    
    logger.info("No category matched, defaulting to 'Autre'")
    return 'Autre'


# Optional HuggingFace zero-shot classification (fallback/augment keyword matching)
ZERO_SHOT_AVAILABLE = False
zero_shot_classifier = None

def get_zero_shot_classifier():
    """Lazy-load the zero-shot classifier to avoid blocking startup"""
    global zero_shot_classifier, ZERO_SHOT_AVAILABLE
    
    if zero_shot_classifier is not None or ZERO_SHOT_AVAILABLE:
        return zero_shot_classifier
    
    try:
        from transformers import pipeline
        zero_shot_classifier = pipeline('zero-shot-classification', device=-1)
        ZERO_SHOT_AVAILABLE = True
        logger.info('Zero-shot classification pipeline loaded')
        return zero_shot_classifier
    except Exception as e:
        logger.warning(f'Zero-shot pipeline not available: {e}')
        ZERO_SHOT_AVAILABLE = False
        return None

def classify_with_zero_shot(text):
    """Attempt classification using a zero-shot model into our expense labels."""
    if not text:
        return None
    try:
        classifier = get_zero_shot_classifier()
        if not classifier:
            return None
        
        labels = ['Alimentation', 'Transport', 'Loisirs', 'Santé', 'Logement', 'Education', 'Autre']
        result = classifier(text, labels)
        # result: {'labels': [...], 'scores': [...]}
        if 'labels' in result and len(result['labels']) > 0:
            return result['labels'][0]
    except Exception as e:
        logger.warning(f'Zero-shot classification failed: {e}')
    return None

def extract_merchant_name(text):
    """Extract merchant/store name from receipt"""
    if not text:
        return 'Reçu'
    
    # Look for common merchant indicators
    text_upper = text.upper()
    if 'ZARA' in text_upper or 'INDITEX' in text_upper:
        return 'ZARA'
    if 'STARBUCKS' in text_upper:
        return 'STARBUCKS'
    if 'LUXOLOR' in text_upper:
        return 'STE LUXOLOR RETAIL'
    if 'UIB' in text_upper:
        return 'UIB'
        
    patterns = [
        r'(?:magasin|store|shop|restaurant|bar|café|commerce)\s*:?\s*([^\n]+)',
        r'^([a-zA-ZÀ-ÿ\s\d&\-\.,]+)\n',  # First line (usually merchant name)
    ]
    
    for pattern in patterns:
        match = re.search(pattern, text, re.IGNORECASE | re.MULTILINE)
        if match:
            merchant = match.group(1).strip()
            # Clean up: remove addresses if they were caught (Rue, Avenue, etc.)
            merchant = re.split(r'\b(RUE|AVE|AVENUE|BD|BOULEVARD|STREET|ST)\b', merchant, flags=re.IGNORECASE)[0].strip()
            if merchant and len(merchant) > 2:
                return merchant[:100]
    
    return 'Reçu'

@app.route('/health', methods=['GET'])
def health_check():
    """Health check endpoint"""
    return jsonify({'status': 'ok', 'service': 'Receipt OCR API'}), 200

@app.route('/api/process-receipt', methods=['POST'])
def process_receipt():
    """
    Main API endpoint - receives receipt image and returns extracted data
    Expected form data: receipt (image file)
    Returns JSON with: montant, categorie, date, typePaiement, titre
    """
    try:
        logger.info("Processing receipt request")
        
        # Check if receipt file is present
        logger.info(f"Available files in request: {list(request.files.keys())}")
        if 'receipt' not in request.files:
            logger.error("No receipt file provided in Python request")
            return jsonify({'error': '[PY-FILES-MISSING] No receipt image provided in Python request'}), 400
        
        file = request.files['receipt']
        logger.info(f"Received file: '{file.filename}', Content-Type: {file.content_type}")
        
        if file.filename == '':
            logger.error("Empty filename")
            return jsonify({'error': 'No file selected'}), 400
        
        # Fallback for filenames without extension or suspicious extensions
        filename = file.filename
        content_type = file.content_type or ''
        
        # If it's definitely an image according to mime type, be permissive
        is_image_mime = 'image/' in content_type or 'application/octet-stream' in content_type
        
        if not allowed_file(filename) and not is_image_mime:
            allowed_msg = ", ".join(sorted(list(ALLOWED_EXTENSIONS)))
            logger.error(f"Rejection: {filename} (Mime: {content_type})")
            return jsonify({'error': f'Format de fichier non supporté ({filename}). Formats autorisés : {allowed_msg}'}), 400
        
        # If no extension but image mime, force .jpg
        if '.' not in filename:
            filename = f"{filename}.jpg"
            logger.info(f"Appended .jpg to extensionless filename: {filename}")
        
        # Save uploaded file
        filename = secure_filename(file.filename)
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)
        logger.info(f"File saved to: {filepath}")
        
        # Extract data from receipt
        start_time = time.time()
        text = extract_text_from_receipt(filepath)
        ocr_time = time.time() - start_time
        logger.info(f"OCR completed in {ocr_time:.2f}s")
        
        if text.startswith('Error:'):
            return jsonify({'error': text}), 500
        
        amount = extract_amount(text)
        date = extract_date(text)
        payment_method = extract_payment_method(text)
        
        # First try rule-based categorization (FAST)
        cat_start = time.time()
        category = categorize_expense(text)
        
        # Zero-shot is now DISABLED by default for speed
        if category == 'Autre' and ZERO_SHOT_AVAILABLE:
            try:
                model_label = classify_with_zero_shot(text)
                if model_label:
                    logger.info(f"Zero-shot model classified as: {model_label}")
                    category = model_label
            except Exception as e:
                logger.warning(f"Zero-shot classification skipped: {e}")
        cat_time = time.time() - cat_start
        logger.info(f"Categorization completed in {cat_time:.2f}s")
        
        merchant = extract_merchant_name(text)
        
        total_time = time.time() - start_time
        logger.info(f"Total processing time: {total_time:.2f}s")
        
        logger.info(f"Extraction complete - Amount: {amount}, Category: {category}")
        
        # Cleanup
        try:
            os.remove(filepath)
        except:
            pass
        
        return jsonify({
            'success': True,
            'montant': amount,
            'categorie': category,
            'date': date,
            'typePaiement': payment_method,
            'titre': merchant,
            'raw_text': text[:300]  # First 300 chars for verification
        }), 200
    
    except Exception as e:
        logger.error(f"Error processing receipt: {str(e)}\n{traceback.format_exc()}")
        return jsonify({
            'error': f'Error processing receipt: {str(e)}'
        }), 500

@app.route('/api/debug', methods=['POST'])
def debug_ocr():
    """Debug endpoint to see raw OCR output"""
    try:
        if 'receipt' not in request.files:
            return jsonify({'error': 'No receipt image provided'}), 400
        
        file = request.files['receipt']
        filename = secure_filename(file.filename)
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)
        
        text = extract_text_from_receipt(filepath)
        
        try:
            os.remove(filepath)
        except:
            pass
        
        return jsonify({
            'raw_text': text,
            'text_length': len(text)
        }), 200
    
    except Exception as e:
        logger.error(f"Debug error: {str(e)}")
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    print("=" * 60)
    print("Receipt OCR & AI Expense Categorization Service")
    print("=" * 60)
    print("Service running on http://localhost:5000")
    print("Endpoints:")
    print("  POST /api/process-receipt - Process receipt image")
    print("  GET  /health             - Health check")
    print("=" * 60)
    app.run(debug=True, port=5000, host='0.0.0.0')
