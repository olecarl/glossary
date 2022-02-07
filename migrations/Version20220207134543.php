<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220207134543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "create table term";
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE term (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(64) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE term');
    }
}
