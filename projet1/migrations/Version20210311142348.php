<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311142348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve ADD classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F78F5EA509 ON eleve (classe_id)');
        $this->addSql('ALTER TABLE rattrapage ADD surveillant_id INT NOT NULL, ADD intervenant_id INT NOT NULL, CHANGE pdfcorrige pdf VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DAA23F281 FOREIGN KEY (surveillant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_BDE5586DAA23F281 ON rattrapage (surveillant_id)');
        $this->addSql('CREATE INDEX IDX_BDE5586DAB9A1716 ON rattrapage (intervenant_id)');
        $this->addSql('ALTER TABLE utilisateur ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3D60322AC ON utilisateur (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('DROP INDEX IDX_ECA105F78F5EA509 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP classe_id');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DAA23F281');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DAB9A1716');
        $this->addSql('DROP INDEX IDX_BDE5586DAA23F281 ON rattrapage');
        $this->addSql('DROP INDEX IDX_BDE5586DAB9A1716 ON rattrapage');
        $this->addSql('ALTER TABLE rattrapage DROP surveillant_id, DROP intervenant_id, CHANGE pdf pdfcorrige VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP INDEX IDX_1D1C63B3D60322AC ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP role_id');
    }
}
