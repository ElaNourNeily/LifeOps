<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260209215832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task_space_members (task_space_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_80A3C4E66397B90C (task_space_id), INDEX IDX_80A3C4E6FB88E14F (utilisateur_id), PRIMARY KEY (task_space_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE task_space_members ADD CONSTRAINT FK_80A3C4E66397B90C FOREIGN KEY (task_space_id) REFERENCES task_space (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_space_members ADD CONSTRAINT FK_80A3C4E6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache ADD estimated_time DOUBLE PRECISION DEFAULT NULL, ADD real_time_spent DOUBLE PRECISION DEFAULT NULL, ADD assigned_to_id INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE priorite priorite INT NOT NULL, CHANGE difficulte difficulte INT DEFAULT NULL, CHANGE statut statut VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075F4BD7827 FOREIGN KEY (assigned_to_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_93872075F4BD7827 ON tache (assigned_to_id)');
        $this->addSql('ALTER TABLE task_space ADD description LONGTEXT DEFAULT NULL, ADD sprint_duration INT NOT NULL, ADD status VARCHAR(50) NOT NULL, DROP type, CHANGE date_creation date_creation DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_space_members DROP FOREIGN KEY FK_80A3C4E66397B90C');
        $this->addSql('ALTER TABLE task_space_members DROP FOREIGN KEY FK_80A3C4E6FB88E14F');
        $this->addSql('DROP TABLE task_space_members');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075F4BD7827');
        $this->addSql('DROP INDEX IDX_93872075F4BD7827 ON tache');
        $this->addSql('ALTER TABLE tache DROP estimated_time, DROP real_time_spent, DROP assigned_to_id, CHANGE description description LONGTEXT NOT NULL, CHANGE statut statut VARCHAR(255) NOT NULL, CHANGE priorite priorite VARCHAR(255) NOT NULL, CHANGE difficulte difficulte INT NOT NULL');
        $this->addSql('ALTER TABLE task_space ADD type VARCHAR(255) NOT NULL, DROP description, DROP sprint_duration, DROP status, CHANGE date_creation date_creation DATE NOT NULL');
    }
}
