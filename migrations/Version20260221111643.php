<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260221111643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bilan_sante (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, niveau_fatigue INT NOT NULL, niveau_stress INT NOT NULL, score_forme DOUBLE PRECISION NOT NULL, risque_burnout TINYINT NOT NULL, recommandations LONGTEXT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_C7A02BD6FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE budget (id INT AUTO_INCREMENT NOT NULL, revenu_mensuel DOUBLE PRECISION NOT NULL, plafond DOUBLE PRECISION NOT NULL, mois VARCHAR(255) NOT NULL, economies DOUBLE PRECISION NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_73F2F77BFB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, categorie VARCHAR(255) NOT NULL, date DATE NOT NULL, type_paiement VARCHAR(255) NOT NULL, utilisateur_id INT NOT NULL, budget_id INT NOT NULL, INDEX IDX_34059757FB88E14F (utilisateur_id), INDEX IDX_3405975736ABA6B8 (budget_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, progression INT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, utilisateur_id INT NOT NULL, INDEX IDX_E2F86851FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE plan_action (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, priorite VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, objectif_id INT NOT NULL, INDEX IDX_F39494E0157D1AD4 (objectif_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE suivi_sante (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, heures_sommeil DOUBLE PRECISION NOT NULL, qualite_sommeil INT NOT NULL, verres_eau INT NOT NULL, minutes_activite INT NOT NULL, poids DOUBLE PRECISION DEFAULT NULL, humeur INT NOT NULL, notes LONGTEXT DEFAULT NULL, activite VARCHAR(255) DEFAULT NULL, utilisateur_id INT NOT NULL, bilan_sante_id INT DEFAULT NULL, INDEX IDX_6C041248FB88E14F (utilisateur_id), INDEX IDX_6C0412484FE3D2F4 (bilan_sante_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, priorite VARCHAR(255) NOT NULL, difficulte INT NOT NULL, statut VARCHAR(255) NOT NULL, deadline DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, task_space_id INT DEFAULT NULL, utilisateur_id INT NOT NULL, INDEX IDX_938720756397B90C (task_space_id), INDEX IDX_93872075FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE task_space (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_EED6DA1AFB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE bilan_sante ADD CONSTRAINT FK_C7A02BD6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_3405975736ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan_action ADD CONSTRAINT FK_F39494E0157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE suivi_sante ADD CONSTRAINT FK_6C041248FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE suivi_sante ADD CONSTRAINT FK_6C0412484FE3D2F4 FOREIGN KEY (bilan_sante_id) REFERENCES bilan_sante (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720756397B90C FOREIGN KEY (task_space_id) REFERENCES task_space (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE task_space ADD CONSTRAINT FK_EED6DA1AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE activite DROP categorie, DROP couleur');
        $this->addSql('ALTER TABLE utilisateur ADD is_verified TINYINT NOT NULL, ADD verification_code VARCHAR(6) DEFAULT NULL, ADD verification_code_expires_at DATETIME DEFAULT NULL, ADD google_id VARCHAR(255) DEFAULT NULL, ADD facebook_id VARCHAR(255) DEFAULT NULL, ADD github_id VARCHAR(255) DEFAULT NULL, ADD telephone VARCHAR(20) DEFAULT NULL, ADD has_set_password TINYINT NOT NULL, CHANGE role role VARCHAR(50) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B376F5C865 ON utilisateur (google_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B39BE8FD98 ON utilisateur (facebook_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3D4327649 ON utilisateur (github_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bilan_sante DROP FOREIGN KEY FK_C7A02BD6FB88E14F');
        $this->addSql('ALTER TABLE budget DROP FOREIGN KEY FK_73F2F77BFB88E14F');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757FB88E14F');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_3405975736ABA6B8');
        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F86851FB88E14F');
        $this->addSql('ALTER TABLE plan_action DROP FOREIGN KEY FK_F39494E0157D1AD4');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE suivi_sante DROP FOREIGN KEY FK_6C041248FB88E14F');
        $this->addSql('ALTER TABLE suivi_sante DROP FOREIGN KEY FK_6C0412484FE3D2F4');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720756397B90C');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075FB88E14F');
        $this->addSql('ALTER TABLE task_space DROP FOREIGN KEY FK_EED6DA1AFB88E14F');
        $this->addSql('DROP TABLE bilan_sante');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE plan_action');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE suivi_sante');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE task_space');
        $this->addSql('ALTER TABLE activite ADD categorie VARCHAR(50) DEFAULT NULL, ADD couleur VARCHAR(7) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_1D1C63B376F5C865 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B39BE8FD98 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3D4327649 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP is_verified, DROP verification_code, DROP verification_code_expires_at, DROP google_id, DROP facebook_id, DROP github_id, DROP telephone, DROP has_set_password, CHANGE role role ENUM(\'ROLE_USER\', \'ROLE_ADMIN\', \'ROLE_GROUP\') DEFAULT \'ROLE_USER\' NOT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }
}
