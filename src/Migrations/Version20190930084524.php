<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930084524 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unite_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, quantite INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6BAF7870EC4A74AB ON ingredient (unite_id)');
        $this->addSql('CREATE TABLE unite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE avis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recette_id INTEGER DEFAULT NULL, pseudo VARCHAR(255) NOT NULL, commentaire CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8F91ABF089312FE9 ON avis (recette_id)');
        $this->addSql('CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE categorie_recettes (categorie_id INTEGER NOT NULL, recettes_id INTEGER NOT NULL, PRIMARY KEY(categorie_id, recettes_id))');
        $this->addSql('CREATE INDEX IDX_D3CFA646BCF5E72D ON categorie_recettes (categorie_id)');
        $this->addSql('CREATE INDEX IDX_D3CFA6463E2ED6D6 ON categorie_recettes (recettes_id)');
        $this->addSql('CREATE TABLE ustensiles (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE ustensiles_recettes (ustensiles_id INTEGER NOT NULL, recettes_id INTEGER NOT NULL, PRIMARY KEY(ustensiles_id, recettes_id))');
        $this->addSql('CREATE INDEX IDX_69079DD0E470D56B ON ustensiles_recettes (ustensiles_id)');
        $this->addSql('CREATE INDEX IDX_69079DD03E2ED6D6 ON ustensiles_recettes (recettes_id)');
        $this->addSql('CREATE TABLE recettes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, temps_preparation INTEGER NOT NULL, temps_cuisson INTEGER NOT NULL, prix INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE etapes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recette_id INTEGER DEFAULT NULL, description CLOB NOT NULL, ordre INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_E3443E1789312FE9 ON etapes (recette_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE unite');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_recettes');
        $this->addSql('DROP TABLE ustensiles');
        $this->addSql('DROP TABLE ustensiles_recettes');
        $this->addSql('DROP TABLE recettes');
        $this->addSql('DROP TABLE etapes');
    }
}
