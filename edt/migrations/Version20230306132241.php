<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306132241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_cours ADD cours_id INT NOT NULL');
        $this->addSql('ALTER TABLE avis_cours ADD CONSTRAINT FK_8A020DE27ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_8A020DE27ECF78B0 ON avis_cours (cours_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_cours DROP FOREIGN KEY FK_8A020DE27ECF78B0');
        $this->addSql('DROP INDEX IDX_8A020DE27ECF78B0 ON avis_cours');
        $this->addSql('ALTER TABLE avis_cours DROP cours_id');
    }
}
