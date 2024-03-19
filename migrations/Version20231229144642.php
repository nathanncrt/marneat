<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231229144642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commenter ADD date_publi DATETIME NOT NULL');
        $this->addSql('ALTER TABLE contenir ADD unite_mesure VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE recette ADD affiche LONGBLOB DEFAULT NULL, ADD nb_pers INT NOT NULL, ADD difficulte INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette DROP affiche, DROP nb_pers, DROP difficulte');
        $this->addSql('ALTER TABLE commenter DROP date_publi');
        $this->addSql('ALTER TABLE contenir DROP unite_mesure');
    }
}
