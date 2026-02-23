<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260208203053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suivi_sante ADD qualite_sommeil INT NOT NULL, ADD verres_eau INT NOT NULL, ADD minutes_activite INT NOT NULL, ADD poids DOUBLE PRECISION DEFAULT NULL, ADD humeur INT NOT NULL, ADD notes LONGTEXT DEFAULT NULL, CHANGE activite activite VARCHAR(255) DEFAULT NULL, CHANGE sommeil heures_sommeil DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE suivi_sante DROP qualite_sommeil, DROP verres_eau, DROP minutes_activite, DROP poids, DROP humeur, DROP notes, CHANGE activite activite VARCHAR(255) NOT NULL, CHANGE heures_sommeil sommeil DOUBLE PRECISION NOT NULL');
    }
}
