#!/usr/bin/env python3
"""Test script to POST receipt to OCR service and display results"""

import requests
import glob
import json
import time

# Wait for Flask to reload
time.sleep(1)

# Find the jfif file in Downloads
jfif_files = glob.glob(r'c:\Users\arijm\Downloads\*.jfif')
if not jfif_files:
    print('No JFIF file found in Downloads')
else:
    receipt_path = jfif_files[0]
    print(f'Found: {receipt_path}')
    print('=' * 60)
    
    # POST to OCR service
    with open(receipt_path, 'rb') as f:
        files = {'receipt': f}
        response = requests.post('http://127.0.0.1:5000/api/process-receipt', files=files)
    
    result = response.json()
    
    print('\nOCR EXTRACTION RESULT:')
    print(json.dumps(result, indent=2, ensure_ascii=False))
    
    print('\n' + '=' * 60)
    print('FORM AUTO-FILL PREVIEW:')
    print('=' * 60)
    if 'success' in result and result['success']:
        print(f'Titre: {result.get("titre", "N/A")}')
        print(f'Montant: {result.get("montant", "N/A")} TND')
        print(f'Categorie: {result.get("categorie", "N/A")}')
        print(f'Date: {result.get("date", "N/A")}')
        print(f'Type Paiement: {result.get("typePaiement", "N/A")}')
    else:
        print(f'Error: {result.get("error", "Unknown error")}')
