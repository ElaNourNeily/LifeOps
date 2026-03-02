<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add receipt_image field to Depense for OCR functionality
 */
final class Version20260221120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add receipt_image field to Depense table for OCR receipt processing';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE depense ADD receipt_image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE depense DROP receipt_image');
    }
}
