<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311143444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rattrapage_eleve');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rattrapage_eleve (rattrapage_id INT NOT NULL, eleve_id INT NOT NULL, INDEX IDX_F6B7ADAC844C5C55 (rattrapage_id), INDEX IDX_F6B7ADACA6CC7B2 (eleve_id), PRIMARY KEY(rattrapage_id, eleve_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE rattrapage_eleve ADD CONSTRAINT FK_F6B7ADAC844C5C55 FOREIGN KEY (rattrapage_id) REFERENCES rattrapage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rattrapage_eleve ADD CONSTRAINT FK_F6B7ADACA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON DELETE CASCADE');
    }
}
