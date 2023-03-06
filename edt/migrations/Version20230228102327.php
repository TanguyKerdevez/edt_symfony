<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228102327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis ADD note SMALLINT NOT NULL, ADD commentaire LONGTEXT NOT NULL, ADD email_etudiant VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE matiere ADD titre VARCHAR(255) NOT NULL, ADD reference VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE professeur ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_17A55299E7927C74 ON professeur (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP note, DROP commentaire, DROP email_etudiant');
        $this->addSql('ALTER TABLE matiere DROP titre, DROP reference');
        $this->addSql('DROP INDEX UNIQ_17A55299E7927C74 ON professeur');
        $this->addSql('ALTER TABLE professeur DROP nom, DROP prenom, DROP email');
    }
}
