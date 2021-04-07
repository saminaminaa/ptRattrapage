<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407071313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rattrapage ADD classe_id INT NOT NULL, CHANGE pdf pdf VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586D8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_BDE5586D8F5EA509 ON rattrapage (classe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586D8F5EA509');
        $this->addSql('DROP INDEX IDX_BDE5586D8F5EA509 ON rattrapage');
        $this->addSql('ALTER TABLE rattrapage DROP classe_id, CHANGE pdf pdf VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
