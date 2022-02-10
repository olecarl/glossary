<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210212120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE term_set (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE term ADD term_set_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE term ADD CONSTRAINT FK_A50FE78DF3AD3475 FOREIGN KEY (term_set_id) REFERENCES term_set (id)');
        $this->addSql('CREATE INDEX IDX_A50FE78DF3AD3475 ON term (term_set_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE term DROP FOREIGN KEY FK_A50FE78DF3AD3475');
        $this->addSql('DROP TABLE term_set');
        $this->addSql('DROP INDEX IDX_A50FE78DF3AD3475 ON term');
        $this->addSql('ALTER TABLE term DROP term_set_id, CHANGE name name VARCHAR(64) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE url url VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
