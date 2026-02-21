# 📧 LifeOps Mailing Bundle - Quick Start

## What is It?

Instead of downloading PDFs to your PC, the **Mailing Bundle** lets you:
- 📧 Send budget reports directly to email
- 📤 Bulk send to multiple recipients
- ⏰ Schedule emails for later
- 🔒 Choose between strong reliability or weak (fast) mode
- 📊 Automatic PDF generation with personalized data

---

## 5-Minute Setup

### Step 1: Run Database Migration

```bash
php bin/console doctrine:migrations:migrate
```

This creates the `mailing` table.

### Step 2: Create Uploads Directory

```bash
mkdir -p public/uploads/mailings
chmod 755 public/uploads/mailings
```

PDFs will be stored here.

### Step 3: Configure Email (`.env`)

```dotenv
MAILER_DSN=smtp://username:password@smtp.gmail.com:587?encryption=tls
```

For Gmail:
- **Username**: Your Gmail address
- **Password**: Your Gmail [App Password](https://myaccount.google.com/apppasswords)
- Keep `@smtp.gmail.com:587?encryption=tls`

### Step 4: Clear Cache

```bash
php bin/console cache:clear
```

---

## Using the Mailing Bundle

### Navigate to Mailing

1. Go to **Finances** (💰 in the sidebar)
2. Click **📧 Envois** button
3. You'll see your mailing dashboard

### Create Your First Mailing

1. Click **➕ Nouvel Envoi**
2. Fill in:
   - **Destinataires**: `john@example.com, jane@example.com` (comma-separated)
   - **Sujet**: `Mon Rapport Budgétaire`
   - **Message**: (Optional) `Voici mon rapport du mois...`
   - **Budget**: Select the month
   - **Cohérence**: Choose 🔒 or ⚡
   - **Options**: Check boxes for charts/summary
3. Click **Envoyer Maintenant** or **Programmer l'Envoi**

### Statuses

| Icon | Status | Meaning |
|------|--------|---------|
| 🔵 | brouillon | Draft (can edit) |
| 🟡 | en_attente | Scheduled (waiting) |
| 🟢 | envoyé | Sent successfully ✅ |
| 🔴 | erreur | Failed (can retry) |

---

## Understanding Consistency Bundles

### 🔒 Bundle Consistant (Strong Consistency)

**Best for:** Important reports, official documents

**Includes:**
- ✅ All expenses in the report
- ✅ Complete graphics & analysis
- ✅ Full financial summary
- ✅ Executive recommendations
- ✅ Guaranteed delivery

**Speed:** Slightly slower (more data)

### ⚡ Bundle de Consistance Faible (Weak Consistency)

**Best for:** Regular updates, quick notifications

**Includes:**
- ⚡ Last 5 expenses only
- 📊 Essential graphics
- 💡 Brief summary
- 🚀 Optimized for speed
- ✅ Fast delivery

**Speed:** Much faster (limited data)

---

## Example Workflows

### Workflow 1: Send Monthly Report to Boss

```
1. Go to Finances → Envois
2. Click Nouvel Envoi
3. Destinataires: boss@company.com, accounting@company.com
4. Sujet: Rapport Budgétaire Février 2026
5. Message: Rapportbud du mois (en pièce jointe)
6. Budget: 2026-02
7. Cohérence: 🔒 Consistant
8. Inclure graphiques: ✓
9. Inclure résumé: ✓
10. Clic Envoyer Maintenant
```

### Workflow 2: Weekly Status to Team

```
1. Go to Finances → Envois
2. Click Nouvel Envoi
3. Destinataires: team@company.com
4. Sujet: Status Dépenses Semaine
5. Message: (leave empty for template default)
6. Budget: 2026-02
7. Cohérence: ⚡ Faible
8. Inclure graphiques: ✗ (faster)
9. Inclure résumé: ✓
10. Clic Envoyer Maintenant
```

### Workflow 3: Scheduled Report Tomorrow

```
1. Go to Finances → Envois
2. Click Nouvel Envoi
3. Destinataires: finance@domain.com
4. Sujet: Rapport Mensuel Automatisé
5. Budget: 2026-02
6. Date programmée: Demain à 08:00
7. Cohérence: 🔒 Consistant
8. Inclure graphiques: ✓
9. Inclure résumé: ✓
10. Clic Programmer l'Envoi
```

---

## Features Breakdown

### Email Validation

- ✅ Automatically validates email format
- ✅ "invalid@" → ✗ rejected
- ✅ "test@domain.com" → ✓ accepted
- ✅ Comma-separated: `a@b.com, c@d.com`

### PDF Generation

- **Template 1**: Personalized report (used by default)
- **Template 2**: Budget analysis report
- **Auto-format**: Converts HTML → PDF
- **Attachable**: Sent as email attachment
- **Quality**: Professional design with charts

### Security

- ✅ Users can only manage their own mailings
- ✅ CSRF token protection
- ✅ Email injection prevention
- ✅ Access control via voters
- ✅ All input validated

---

## Troubleshooting

### Email Not Sending?

**Check:**
```bash
# Test email configuration
php bin/console mailer:test your-email@example.com
```

**If fails:**
1. Verify `MAILER_DSN` in `.env`
2. Check Gmail password (use App Password, not Gmail password)
3. Whitelist sender address in your email provider
4. Check firewall isn't blocking port 587

### PDF Says "Not Found"?

```bash
# Ensure directory exists and is writable
mkdir -p public/uploads/mailings
chmod 755 public/uploads/mailings
ls -la public/uploads/mailings/
```

### Database Error?

```bash
# Run migration again
php bin/console doctrine:migrations:migrate --force

# Or check status
php bin/console doctrine:migrations:status
```

---

## View Your Mailings

### List All Mailings
- Go to **Finances → 📧 Envois**
- See all mailings with status
- Click to view details

### View Single Mailing
- Click mailing from list
- See:
  - Recipients
  - Subject
  - Status
  - Generated PDF
  - Error messages (if any)

### Download PDF
- From mailing detail page
- Click **⬇️ Télécharger**
- PDF downloads to your computer

### Edit Draft
- Only **brouillon** (draft) mailings can be edited
- Click **✏️ Éditer**
- Update any field
- Click **💾 Mettre à Jour**

### Retry Failed Email
- If status is **🔴 erreur**
- Click **✉️ Envoyer Maintenant**
- System retries sending
- Check status after

### Delete Mailing
- Click **🗑️ Supprimer**
- Confirm deletion
- Removed from database

---

## Statistics Dashboard

On the **Envois** page, see:

- **Total**: Total mailings created
- **Envoyés**: Successfully sent ✅
- **En Attente**: Scheduled for later ⏱️
- **Erreurs**: Failed (can retry) ❌
- **Brouillons**: Still drafts 📝
- **🔒 Consistant**: Strong consistency count
- **⚡ Faible**: Weak consistency count

---

## Tips & Tricks

### 💡 Pro Tips

1. **Use Weak Bundle for testing** - Faster feedback
2. **Switch to Strong for important reports** - Better data
3. **Schedule off-peak mailing** - Less server load
4. **Add support contacts** - For monitoring
5. **Use clear subjects** - Helps recipients
6. **Test with yourself first** - Self-send test

### 🚫 Avoid

- ❌ Too many recipients at once (start with <100)
- ❌ Large attachments additionally
- ❌ Sending to invalid emails repeatedly
- ❌ Forgetting to clear cache after config change

---

## Command Line Tools

### Send Scheduled Mailings (Cron)

```bash
# Check which mailings are scheduled
php bin/console doctrine:query:sql "SELECT id, sujet, date_programmee FROM mailing WHERE statut='en_attente'"

# Manual send (if no cron available)
php bin/console app:send-scheduled-mailings
```

### Create Mailing from Command

```php
// In a command...
$mailing = new Mailing();
$mailing->setUtilisateur($user);
$mailing->setBudget($budget);
$mailing->setDestinataires('test@example.com');
$mailing->setSujet('API Test');
$pdfFile = $this->mailingService->generatePersonalizedPDF($budget, $user);
$mailing->setRapportPdf($pdfFile);
$this->mailingService->sendImmediately($mailing);
```

---

## Common Issues & Solutions

| Issue | Cause | Solution |
|-------|-------|----------|
| "MAILER_DSN not found" | Missing `.env` config | Add `MAILER_DSN=...` to `.env` |
| "PDF file not found" | Upload dir missing | `mkdir -p public/uploads/mailings` |
| "Invalid email" | Bad format | Use `email@domain.com` (with @) |
| "Permission denied" | Wrong directory perms | `chmod 755 public/uploads/mailings` |
| Email times out | Server/network issue | Check firewall, try different SMTP |
| PDF blank | Template error | Check Twig render, clear cache |

---

## What's Next?

- [📖 Read full documentation](MAILING_BUNDLE.md)
- 🔧 Configure scheduled sending (cron job)
- 📧 Set up email template customization
- 🔐 Add reCAPTCHA for extra security
- 📊 Create mailing analytics dashboard
- 🌍 Add internationalization (i18n)

---

## Support

For issues or questions:

1. Check [Full Documentation](MAILING_BUNDLE.md)
2. Review [Troubleshooting Section](#troubleshooting)
3. Check logs: `var/log/dev.log`
4. Review Symfony Mailer docs: https://symfony.com/doc/current/mailer.html

---

**Version**: v1.0.0  
**Release Date**: February 21, 2026  
**Status**: ✅ Production Ready
