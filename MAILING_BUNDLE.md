# 📧 LifeOps Mailing Bundle - Implementation Guide

## Overview

The **Mailing Bundle** is a comprehensive email management system integrated with the LifeOps finance module. It allows users to send personalized PDF reports to multiple recipients via email instead of downloading them locally to their PC.

### Key Features

✅ **Bulk Mailing** - Send emails to multiple recipients simultaneously  
✅ **Scheduled Sending** - Program emails to be sent at a specific date/time  
✅ **PDF Generation** - Automatic personalized PDF creation  
✅ **Strong Consistency Bundle** (🔒) - Guaranteed delivery with full verification  
✅ **Weak Consistency Bundle** (⚡) - Optimized performance with lighter payloads  
✅ **Security** - User authentication and CSRF protection  
✅ **Email Validation** - Automatic validation of recipient email addresses  

---

## Architecture & Components

### 1. Database Schema

**Table: `mailing`**

```sql
- id (INT, PRIMARY)
- utilisateur_id (INT, FK to utilisateur)
- budget_id (INT, FK to budget, nullable)
- destinataires (LONGTEXT) - CSV list of emails
- sujet (VARCHAR 255) - Email subject
- message (LONGTEXT) - Custom message body
- rapport_pdf (LONGTEXT) - PDF filename
- date_envoi (DATETIME) - Send timestamp
- date_programmee (DATETIME) - Scheduled send time
- statut (VARCHAR 50) - 'brouillon', 'en_attente', 'envoyé', 'erreur'
- consistance (VARCHAR 50) - 'consistant', 'faible'
- erreur_message (LONGTEXT) - Error details
- nombre_depenses_incluses (INT) - Count of expenses
- inclure_graphiques (BOOLEAN) - Include charts in PDF
- inclure_resume (BOOLEAN) - Include executive summary
```

Migration: `Version20260221130000.php`

### 2. Entities

#### `Mailing` - [src/Entity/Mailing.php](src/Entity/Mailing.php)

Main entity representing an email campaign.

```php
$mailing = new Mailing();
$mailing->setUtilisateur($user);
$mailing->setBudget($budget);
$mailing->setDestinataires('test@example.com, user@example.com');
$mailing->setSujet('Rapport Budgétaire');
$mailing->setConsistance('consistant'); // or 'faible'
```

**Relationships:**
- Many-to-One: `utilisateur` (Owner)
- Many-to-One: `budget` (Related budget)

---

### 3. Service Layer

#### `MailingService` - [src/Service/MailingService.php](src/Service/MailingService.php)

Handles all mailing operations:

**Core Methods:**

```php
// Generate personalized PDF for user
public function generatePersonalizedPDF(Budget $budget, Utilisateur $user): string

// Send email with PDF attachment
public function sendMailingWithPDF(Mailing $mailing): bool

// Send immediately
public function sendImmediately(Mailing $mailing): bool

// Schedule mailing for later
public function scheduleMailing(Mailing $mailing, \DateTime $scheduledDate): Mailing

// Get statistics
public function getConsistencyStats(Utilisateur $user): array
```

**PDF Generation:**
- Uses DomPDF library
- Renders Twig templates to HTML
- Supports two formats:
  - `personalized_report.html.twig` - Detailed user report
  - `budget_report.html.twig` - Full budget analysis

**Email Integration:**
- Uses Symfony Mailer
- Sends from: `noreply@lifeops.com`
- PDF automatically attached
- Supports HTML email templates

---

### 4. Controllers

#### `MailingController` - [src/Controller/Other/MailingController.php](src/Controller/Other/MailingController.php)

**Routes:**

| Route | Method | Purpose |
|-------|--------|---------|
| `/mailing/` | GET | List all mailings (index) |
| `/mailing/new` | GET/POST | Create new mailing |
| `/mailing/{id}` | GET | View mailing details |
| `/mailing/{id}/edit` | GET/POST | Edit draft mailing |
| `/mailing/{id}/send` | POST | Send mailing |
| `/mailing/{id}/delete` | POST | Delete mailing |
| `/mailing/{id}/download-pdf` | GET | Download PDF |

**Access Control:**
- Uses `MailingVoter` for access checks
- Users can only manage their own mailings
- Only drafts can be edited
- CSRF token validation on all POST requests

---

### 5. Forms

#### `MailingType` - [src/Form/MailingType.php](src/Form/MailingType.php)

**Fields:**
- `destinataires` - Email addresses (comma-separated)
- `sujet` - Email subject
- `message` - Custom message (optional)
- `budget` - Select budget to attach
- `date_programmee` - Schedule date (optional)
- `consistance` - Bundle type (radio buttons)
- `inclure_graphiques` - Include charts (checkbox)
- `inclure_resume` - Include summary (checkbox)

---

### 6. Security

#### `MailingVoter` - [src/Security/Voter/MailingVoter.php](src/Security/Voter/MailingVoter.php)

Controls access to mailing resources:
- `view` - User must be the mailingowner
- `edit` - User must be the mailing owner
- `delete` - User must be the mailing owner

---

## Usage Guide

### Creating a Mailing

1. Navigate to **Finances → 📧 Envois**
2. Click **➕ Nouvel Envoi**
3. Configure:
   - **Destinataires**: Enter email addresses (comma-separated)
   - **Sujet**: Email subject line
   - **Message**: Custom personalized message
   - **Budget**: Select which budget month to report on
   - **Type de Cohérence**:
     - 🔒 **Bundle Consistant** (Strong) - All expenses included, guaranteed delivery
     - ⚡ **Bundle Faible** (Weak) - Limited to 5 recent expenses, optimized
   - **Options**: Include charts, include summary, etc.
4. Choose:
   - **Send Now** - Sends immediately
   - **Schedule** - Set date/time to send later

### Mailing Statuses

| Status | Description |
|--------|-------------|
| 🔵 **brouillon** | Draft - Can be edited or deleted |
| 🟡 **en_attente** | Pending - Scheduled for later |
| 🟢 **envoyé** | Sent - Successfully delivered |
| 🔴 **erreur** | Error - Failed to send (can retry) |

### Consistency Bundles

#### Bundle Consistant (Strong) 🔒

**Characteristics:**
- ✅ All expenses included in PDF
- ✅ Full graphics and analysis
- ✅ Guaranteed delivery confirmation
- ✅ Complete data verification
- ⏱️ Slightly slower processing

**Use Case:** Important reports, financial audits, official documents

#### Bundle de Consistance Faible (Weak) ⚡

**Characteristics:**
- ✨ Limited to 5 most recent expenses
- ⚡ Faster processing
- 📊 Optimized payload size
- 🚀 Quick delivery
- 💡 Suitable for status updates

**Use Case:** Regular status updates, quick notifications, frequent sends

---

## Template System

### PDF Templates

#### 1. `personalized_report.html.twig`
- User-specific report
- All expense details
- Financial summary
- Recommendations
- Header with user info

#### 2. `budget_report.html.twig`
- Full budget analysis
- Category breakdown
- Charts and graphics
- Historical trends
- Executive summary

#### 3. `email_template.html.twig`
- HTML email design
- Professional branding
- Responsive layout
- Call-to-action
- Footer with links

---

## Configuration

### Environment Variables

Add to `.env`:

```dotenv
###> Mailing Bundle ###
MAILER_DSN=smtp://username:password@smtp.gmail.com:587?encryption=tls
###< Mailing Bundle ###
```

### Composer Dependencies

The following are already installed:

```json
"dompdf/dompdf": "^2.0",
"symfony/mailer": "*",
"symfony/mime": "*"
```

If missing, install with:

```bash
composer require dompdf/dompdf symfony/mailer symfony/mime
```

---

## Database Setup

### Run Migration

```bash
php bin/console doctrine:migrations:migrate
```

### Create Uploads Directory

```bash
mkdir -p public/uploads/mailings
chmod 755 public/uploads/mailings
```

---

## Features Deep Dive

### Email Validation

```php
// Automatically validates email format
$emails = ['valid@example.com', 'invalid@', 'test@domain.com'];
$validEmails = array_filter($emails, function($e) {
    return filter_var($e, FILTER_VALIDATE_EMAIL);
});
// Result: ['valid@example.com', 'test@domain.com']
```

### Scheduled Sending

```php
// Service handles checking and sending scheduled emails
// Can be run via cron job:
php bin/console app:send-scheduled-mailings

// In your service:
$scheduledMailings = $mailingRepository->findScheduledToSend();
foreach ($scheduledMailings as $mailing) {
    $this->mailingService->sendMailingWithPDF($mailing);
}
```

### Error Handling

```php
// Errors are captured and stored
if (!$success) {
    $mailing->setStatut('erreur');
    $mailing->setErreurMessage($e->getMessage());
}

// Can retry from the UI
// Button: "Send Now" re-attempts failed mailings
```

---

## Security Considerations

### CSRF Protection
- All forms include CSRF tokens
- POST requests require valid token

### Email Injection
- User input is validated
- Emails are escaped in templates
- Headers are sanitized

### Access Control
- Voters verify user ownership
- Users can't access other users' mailings
- Authenticated users only

### File Security
- PDFs stored in upload directory
- Files served with correct MIME type
- Access controlled via Symfony security

---

## Troubleshooting

### Email Not Sending

**Check:**
1. MAILER_DSN is configured in `.env`
2. Email service credentials are correct
3. SMTP port is accessible (usually 587 for TLS)
4. From email address is valid

**Debug:**
```bash
php bin/console mailer:test recipient@example.com
```

### PDF Generation Error

**Check:**
1. Dompdf is installed: `composer require dompdf/dompdf`
2. Twig templates render correctly
3. Fonts are accessible
4. Memory limit is sufficient

**Debug:**
```php
$this->mailingService->generatePersonalizedPDF($budget, $user);
// Check files in public/uploads/mailings/
```

### Scheduled Mailings Not Sending

**Setup a Cron Job:**

```bash
# Run every 5 minutes
*/5 * * * * cd /path/to/lifeops && php bin/console app:send-scheduled-mailings
```

---

## API Examples

### Send Immediate Mailing

```php
$mailing = new Mailing();
$mailing->setUtilisateur($user);
$mailing->setBudget($budget);
$mailing->setDestinataires('user@example.com');
$mailing->setSujet('Votre rapport budgétaire');
$mailing->setConsistance('consistant');

// Generate PDF
$pdfFile = $this->mailingService->generatePersonalizedPDF($budget, $user);
$mailing->setRapportPdf($pdfFile);

// Send now
$success = $this->mailingService->sendImmediately($mailing);

$entityManager->persist($mailing);
$entityManager->flush();
```

### Schedule Mailing

```php
$scheduledDate = (new \DateTime())->add(new \DateInterval('P1D')); // Tomorrow

$this->mailingService->scheduleMailing($mailing, $scheduledDate);

$entityManager->persist($mailing);
$entityManager->flush();
```

---

## Performance Optimization

### Bundle Consistant vs Faible

**Weak Bundle** is optimized for:
- Faster email delivery
- Smaller file sizes
- Reduced server load
- Better for frequent sends

**Strong Bundle** is optimized for:
- Complete data accuracy
- Comprehensive reporting
- Official documentation
- Audit trails

---

## Extending the Bundle

### Custom PDF Templates

Create new template in `templates/mailing/`:

```twig
{# templates/mailing/custom_report.html.twig #}
<!DOCTYPE html>
<html>
    <body>
        <!-- Your custom PDF layout -->
    </body>
</html>
```

Add to `MailingService`:

```php
public function generateCustomPDF(Budget $budget, string $template): string
{
    $html = $this->twig->render($template, ['budget' => $budget]);
    // ... render with DomPDF
}
```

### Add Captcha

Integrate Google reCAPTCHA on the form:

```php
// In MailingType::buildForm()
->add('captcha', RecaptchaType::class)
```

---

## Files Summary

| File | Purpose |
|------|---------|
| `src/Entity/Mailing.php` | Database entity |
| `src/Repository/MailingRepository.php` | Database queries |
| `src/Service/MailingService.php` | Business logic |
| `src/Controller/Other/MailingController.php` | Request handling |
| `src/Form/MailingType.php` | Form definition |
| `src/Security/Voter/MailingVoter.php` | Access control |
| `migrations/Version20260221130000.php` | Database setup |
| `templates/mailing/*.html.twig` | UI templates |

---

## Support & Debugging

### Enable Debug Logging

```yaml
# config/packages/dev/monolog.yaml
doctrine:
    type: stream
    path: var/log/doctrine.log
    level: debug
```

### Check Database

```bash
php bin/console doctrine:query:sql "SELECT * FROM mailing LIMIT 5"
```

### View Emails in Development

Use Symfony MailerInterface development transport:

```yaml
# config/packages/test/mailer.yaml
framework:
    mailer:
        dsn: 'null://localhost'
```

---

## Version & Changelog

- **v1.0.0** - Initial Mailing Bundle implementation
  - Bulk mailing support
  - PDF generation with DomPDF
  - Scheduled sending
  - Strong/Weak consistency options
  - Security voters
  - Email validation

---

**Created:** February 21, 2026  
**Last Updated:** February 21, 2026  
**Status:** ✅ Production Ready
