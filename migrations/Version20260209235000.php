<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260209235000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add age column to utilisateur';
    }

    public function up(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();

        if ($platform instanceof \Doctrine\DBAL\Platforms\MySqlPlatform || $platform instanceof \Doctrine\DBAL\Platforms\MariaDBPlatform || stripos(get_class($platform), 'mysql') !== false || stripos(get_class($platform), 'maria') !== false) {
            $this->addSql('ALTER TABLE utilisateur ADD age INT DEFAULT NULL');
        } elseif ($platform instanceof \Doctrine\DBAL\Platforms\PostgreSqlPlatform || stripos(get_class($platform), 'postgres') !== false) {
            $this->addSql('ALTER TABLE utilisateur ADD COLUMN age INT');
        } else {
            $this->write(sprintf('No age column migration implemented for platform: %s', get_class($platform)));
        }
    }

    public function down(Schema $schema): void
    {
        $platform = $this->connection->getDatabasePlatform();
        if ($platform instanceof \Doctrine\DBAL\Platforms\MySqlPlatform || $platform instanceof \Doctrine\DBAL\Platforms\MariaDBPlatform || stripos(get_class($platform), 'mysql') !== false || stripos(get_class($platform), 'maria') !== false) {
            $this->addSql('ALTER TABLE utilisateur DROP age');
        } elseif ($platform instanceof \Doctrine\DBAL\Platforms\PostgreSqlPlatform || stripos(get_class($platform), 'postgres') !== false) {
            $this->addSql('ALTER TABLE utilisateur DROP COLUMN age');
        } else {
            $this->write(sprintf('No rollback implemented for platform: %s', get_class($platform)));
        }
    }
}
