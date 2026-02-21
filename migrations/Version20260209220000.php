<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260209220000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Convert utilisateur.role column to ENUM(USER, ADMIN, GROUP) where supported (MySQL/PostgreSQL)';
    }

    public function up(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();

        // MySQL / MariaDB detection
        if ($platform instanceof \Doctrine\DBAL\Platforms\MySqlPlatform || 
            $platform instanceof \Doctrine\DBAL\Platforms\MariaDBPlatform ||
            stripos(get_class($platform), 'mysql') !== false || stripos(get_class($platform), 'maria') !== false
        ) {
            // Change varchar -> enum
            $this->addSql("ALTER TABLE utilisateur CHANGE `role` `role` ENUM('ROLE_USER','ROLE_ADMIN','ROLE_GROUP') NOT NULL DEFAULT 'ROLE_USER'");
        } elseif ($platform instanceof \Doctrine\DBAL\Platforms\PostgreSqlPlatform || stripos(get_class($platform), 'postgres') !== false) {
            // Create type if not exists, then alter column
            $this->addSql("DO $$ BEGIN IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'userrole') THEN CREATE TYPE userrole AS ENUM ('ROLE_USER','ROLE_ADMIN','ROLE_GROUP'); END IF; END $$;");
            $this->addSql("ALTER TABLE utilisateur ALTER COLUMN role TYPE userrole USING role::userrole;");
            $this->addSql("ALTER TABLE utilisateur ALTER COLUMN role SET DEFAULT 'ROLE_USER';");
        } else {
            // Fallback: leave column as-is (varchar). You can customize for other platforms.
            $this->write(sprintf('No enum conversion implemented for platform: %s', $platform));
        }
    }

    public function down(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform()->getName();

        if ($platform === 'mysql') {
            $this->addSql("ALTER TABLE utilisateur CHANGE `role` `role` VARCHAR(50) NOT NULL DEFAULT 'ROLE_USER'");
        } elseif ($platform === 'postgresql') {
            $this->addSql("ALTER TABLE utilisateur ALTER COLUMN role TYPE VARCHAR(50) USING role::text;");
            $this->addSql("DROP TYPE IF EXISTS userrole;");
        } else {
            $this->write(sprintf('No rollback implemented for platform: %s', $platform));
        }
    }
}
