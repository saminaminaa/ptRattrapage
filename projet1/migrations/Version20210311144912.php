<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311144912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rattrapage ADD module_rattrapage_id INT NOT NULL');
        $this->addSql('ALTER TABLE rattrapage ADD CONSTRAINT FK_BDE5586DD7979CFD FOREIGN KEY (module_rattrapage_id) REFERENCES module_rattrapage (id)');
        $this->addSql('CREATE INDEX IDX_BDE5586DD7979CFD ON rattrapage (module_rattrapage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rattrapage DROP FOREIGN KEY FK_BDE5586DD7979CFD');
        $this->addSql('DROP INDEX IDX_BDE5586DD7979CFD ON rattrapage');
        $this->addSql('ALTER TABLE rattrapage DROP module_rattrapage_id');
    }
}
