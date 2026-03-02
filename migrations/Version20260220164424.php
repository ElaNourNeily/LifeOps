<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260220164424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD is_verified TINYINT NOT NULL, ADD verification_code VARCHAR(6) DEFAULT NULL, ADD verification_code_expires_at DATETIME DEFAULT NULL, ADD google_id VARCHAR(255) DEFAULT NULL, ADD facebook_id VARCHAR(255) DEFAULT NULL, ADD github_id VARCHAR(255) DEFAULT NULL, ADD telephone VARCHAR(20) DEFAULT NULL, ADD has_set_password TINYINT NOT NULL, CHANGE role role VARCHAR(50) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B376F5C865 ON utilisateur (google_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B39BE8FD98 ON utilisateur (facebook_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3D4327649 ON utilisateur (github_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP INDEX UNIQ_1D1C63B376F5C865 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B39BE8FD98 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3D4327649 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP is_verified, DROP verification_code, DROP verification_code_expires_at, DROP google_id, DROP facebook_id, DROP github_id, DROP telephone, DROP has_set_password, CHANGE role role ENUM(\'ROLE_USER\', \'ROLE_ADMIN\', \'ROLE_GROUP\') DEFAULT \'ROLE_USER\' NOT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
