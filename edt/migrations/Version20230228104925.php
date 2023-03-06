<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228104925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE professeur_matiere (professeur_id INT NOT NULL, matiere_id INT NOT NULL, INDEX IDX_FBC82ABCBAB22EE9 (professeur_id), INDEX IDX_FBC82ABCF46CD258 (matiere_id), PRIMARY KEY(professeur_id, matiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professeur_matiere ADD CONSTRAINT FK_FBC82ABCBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_matiere ADD CONSTRAINT FK_FBC82ABCF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD professeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0BAB22EE9 ON avis (professeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professeur_matiere DROP FOREIGN KEY FK_FBC82ABCBAB22EE9');
        $this->addSql('ALTER TABLE professeur_matiere DROP FOREIGN KEY FK_FBC82ABCF46CD258');
        $this->addSql('DROP TABLE professeur_matiere');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0BAB22EE9');
        $this->addSql('DROP INDEX IDX_8F91ABF0BAB22EE9 ON avis');
        $this->addSql('ALTER TABLE avis DROP professeur_id');
    }
}
