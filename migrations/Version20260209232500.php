<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260209232500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add created_at column to utilisateur and populate existing rows';
    }

    public function up(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();

        if ($platform instanceof \Doctrine\DBAL\Platforms\MySqlPlatform || $platform instanceof \Doctrine\DBAL\Platforms\MariaDBPlatform || stripos(get_class($platform), 'mysql') !== false || stripos(get_class($platform), 'maria') !== false) {
            $this->addSql("ALTER TABLE utilisateur ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL");
            // ensure existing rows have a value (CURRENT_TIMESTAMP will handle new rows)
            $this->addSql("UPDATE utilisateur SET created_at = NOW() WHERE created_at IS NULL");
        } elseif ($platform instanceof \Doctrine\DBAL\Platforms\PostgreSqlPlatform || stripos(get_class($platform), 'postgres') !== false) {
            $this->addSql("ALTER TABLE utilisateur ADD COLUMN created_at TIMESTAMP NOT NULL DEFAULT now()");
            $this->addSql("UPDATE utilisateur SET created_at = now() WHERE created_at IS NULL");
        } else {
            $this->write(sprintf('No created_at migration implemented for platform: %s', get_class($platform)));
        }
    }

    public function down(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();

        if ($platform instanceof \Doctrine\DBAL\Platforms\MySqlPlatform || $platform instanceof \Doctrine\DBAL\Platforms\MariaDBPlatform || stripos(get_class($platform), 'mysql') !== false || stripos(get_class($platform), 'maria') !== false) {
            $this->addSql('ALTER TABLE utilisateur DROP created_at');
        } elseif ($platform instanceof \Doctrine\DBAL\Platforms\PostgreSqlPlatform || stripos(get_class($platform), 'postgres') !== false) {
            $this->addSql('ALTER TABLE utilisateur DROP COLUMN created_at');
        } else {
            $this->write(sprintf('No rollback implemented for platform: %s', get_class($platform)));
        }
    }
}
