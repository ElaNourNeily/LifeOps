<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260222144357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, duree INT NOT NULL, priorite INT NOT NULL, etat VARCHAR(255) NOT NULL, heure_debut_estimee TIME NOT NULL, heure_fin_estimee TIME NOT NULL, niveau_urgence VARCHAR(255) NOT NULL, planning_id INT NOT NULL, INDEX IDX_B87555153D865311 (planning_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE bilan_sante (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, niveau_fatigue INT NOT NULL, niveau_stress INT NOT NULL, score_forme DOUBLE PRECISION NOT NULL, risque_burnout TINYINT NOT NULL, recommandations LONGTEXT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_C7A02BD6FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE budget (id INT AUTO_INCREMENT NOT NULL, revenu_mensuel DOUBLE PRECISION NOT NULL, plafond DOUBLE PRECISION NOT NULL, mois VARCHAR(255) NOT NULL, economies DOUBLE PRECISION NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_73F2F77BFB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE depense (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, categorie VARCHAR(255) NOT NULL, date DATE NOT NULL, type_paiement VARCHAR(255) NOT NULL, utilisateur_id INT NOT NULL, budget_id INT NOT NULL, INDEX IDX_34059757FB88E14F (utilisateur_id), INDEX IDX_3405975736ABA6B8 (budget_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, type_feedback VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, note INT NOT NULL, module_cible VARCHAR(255) NOT NULL, date DATETIME NOT NULL, statut VARCHAR(255) NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_D2294458FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE objectif (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, progression INT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, utilisateur_id INT NOT NULL, INDEX IDX_E2F86851FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE plan_action (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, priorite VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, objectif_id INT NOT NULL, INDEX IDX_F39494E0157D1AD4 (objectif_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE planning (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, disponibilite TINYINT NOT NULL, heure_debut_journee TIME NOT NULL, heure_fin_journee TIME NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_D499BFF6FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE suivi_sante (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, heures_sommeil DOUBLE PRECISION NOT NULL, qualite_sommeil INT NOT NULL, verres_eau INT NOT NULL, minutes_activite INT NOT NULL, poids DOUBLE PRECISION DEFAULT NULL, humeur INT NOT NULL, notes LONGTEXT DEFAULT NULL, activite VARCHAR(255) DEFAULT NULL, utilisateur_id INT NOT NULL, bilan_sante_id INT DEFAULT NULL, INDEX IDX_6C041248FB88E14F (utilisateur_id), INDEX IDX_6C0412484FE3D2F4 (bilan_sante_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, priorite VARCHAR(255) NOT NULL, difficulte INT NOT NULL, statut VARCHAR(255) NOT NULL, deadline DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, task_space_id INT DEFAULT NULL, utilisateur_id INT NOT NULL, INDEX IDX_938720756397B90C (task_space_id), INDEX IDX_93872075FB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE task_space (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_EED6DA1AFB88E14F (utilisateur_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, role VARCHAR(50) NOT NULL, photo VARCHAR(255) DEFAULT NULL, empreinte_faciale LONGTEXT DEFAULT NULL, ban_until DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, age INT DEFAULT NULL, is_verified TINYINT NOT NULL, verification_code VARCHAR(6) DEFAULT NULL, verification_code_expires_at DATETIME DEFAULT NULL, google_id VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(255) DEFAULT NULL, github_id VARCHAR(255) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, has_set_password TINYINT NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B376F5C865 (google_id), UNIQUE INDEX UNIQ_1D1C63B39BE8FD98 (facebook_id), UNIQUE INDEX UNIQ_1D1C63B3D4327649 (github_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555153D865311 FOREIGN KEY (planning_id) REFERENCES planning (id)');
        $this->addSql('ALTER TABLE bilan_sante ADD CONSTRAINT FK_C7A02BD6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE budget ADD CONSTRAINT FK_73F2F77BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_3405975736ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE objectif ADD CONSTRAINT FK_E2F86851FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE plan_action ADD CONSTRAINT FK_F39494E0157D1AD4 FOREIGN KEY (objectif_id) REFERENCES objectif (id)');
        $this->addSql('ALTER TABLE planning ADD CONSTRAINT FK_D499BFF6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE suivi_sante ADD CONSTRAINT FK_6C041248FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE suivi_sante ADD CONSTRAINT FK_6C0412484FE3D2F4 FOREIGN KEY (bilan_sante_id) REFERENCES bilan_sante (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720756397B90C FOREIGN KEY (task_space_id) REFERENCES task_space (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE task_space ADD CONSTRAINT FK_EED6DA1AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555153D865311');
        $this->addSql('ALTER TABLE bilan_sante DROP FOREIGN KEY FK_C7A02BD6FB88E14F');
        $this->addSql('ALTER TABLE budget DROP FOREIGN KEY FK_73F2F77BFB88E14F');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757FB88E14F');
        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_3405975736ABA6B8');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458FB88E14F');
        $this->addSql('ALTER TABLE objectif DROP FOREIGN KEY FK_E2F86851FB88E14F');
        $this->addSql('ALTER TABLE plan_action DROP FOREIGN KEY FK_F39494E0157D1AD4');
        $this->addSql('ALTER TABLE planning DROP FOREIGN KEY FK_D499BFF6FB88E14F');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE suivi_sante DROP FOREIGN KEY FK_6C041248FB88E14F');
        $this->addSql('ALTER TABLE suivi_sante DROP FOREIGN KEY FK_6C0412484FE3D2F4');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720756397B90C');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075FB88E14F');
        $this->addSql('ALTER TABLE task_space DROP FOREIGN KEY FK_EED6DA1AFB88E14F');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE bilan_sante');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE depense');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE objectif');
        $this->addSql('DROP TABLE plan_action');
        $this->addSql('DROP TABLE planning');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE suivi_sante');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE task_space');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
