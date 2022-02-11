<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211140101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE term (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', term_set_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(64) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, INDEX IDX_A50FE78DF3AD3475 (term_set_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE term_set (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DF3AD3475 FOREIGN KEY (term_set_id) REFERENCES term_set (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DF3AD3475');
        $this->addSql('DROP TABLE term');
        $this->addSql('DROP TABLE term_set');
    }
}
