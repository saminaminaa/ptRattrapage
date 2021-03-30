<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311151842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve_rattrapage (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, rattrapage_id INT NOT NULL, arendu TINYINT(1) NOT NULL, note INT DEFAULT NULL, date_heure_fin DATETIME DEFAULT NULL, INDEX IDX_BFDFB73FA6CC7B2 (eleve_id), INDEX IDX_BFDFB73F844C5C55 (rattrapage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_rattrapage (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rattrapage (id INT AUTO_INCREMENT NOT NULL, surveillant_id INT NOT NULL, intervenant_id INT NOT NULL, module_rattrapage_id INT NOT NULL, pdf VARCHAR(255) NOT NULL, date_rattrapage DATETIME NOT NULL, duree_rattrapage TIME NOT NULL, corrige VARCHAR(255) DEFAULT NULL, support_sonore TINYINT(1) NOT NULL, etat_rattrapage INT NOT NULL, INDEX IDX_BDE5586DAA23F281 (surveillant_id), INDEX IDX_BDE5586DAB9A1716 (intervenant_id), INDEX IDX_BDE5586DD7979CFD (module_rattrapage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B3D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve_rattrapage ADD CONSTRAINT FK_BFDFB73FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE eleve_rattrapage ADD CONSTRAINT FK_BFDFB73F844C5C55 FOREIGN KEY (rattrapage_id) REFERENCES rattrapage (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DAA23F281 FOREIGN KEY (surveillant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DAB9A1716 FOREIGN KEY (intervenant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DD7979CFD FOREIGN KEY (module_rattrapage_id) REFERENCES module_rattrapage (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE eleve_rattrapage DROP FOREIGN KEY FK_BFDFB73FA6CC7B2');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DD7979CFD');
        $this->addSql('ALTER TABLE eleve_rattrapage DROP FOREIGN KEY FK_BFDFB73F844C5C55');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DAA23F281');
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DAB9A1716');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE eleve_rattrapage');
        $this->addSql('DROP TABLE module_rattrapage');
        $this->addSql('DROP TABLE rattrapage');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
    }
}
