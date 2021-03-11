<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311144521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eleve_rattrapage (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, rattrapage_id INT NOT NULL, arendu TINYINT(1) NOT NULL, note INT DEFAULT NULL, date_heure_fin DATETIME DEFAULT NULL, test VARCHAR(255) DEFAULT NULL, INDEX IDX_BFDFB73FA6CC7B2 (eleve_id), INDEX IDX_BFDFB73F844C5C55 (rattrapage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve_rattrapage ADD CONSTRAINT FK_BFDFB73FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE eleve_rattrapage ADD CONSTRAINT FK_BFDFB73F844C5C55 FOREIGN KEY (rattrapage_id) REFERENCES rattrapage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE eleve_rattrapage');
    }
}
