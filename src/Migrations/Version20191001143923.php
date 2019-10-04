<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001143923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE unity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE cooking_tools (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE cooking_tools_recipes (cooking_tools_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(cooking_tools_id, recipes_id))');
        $this->addSql('CREATE INDEX IDX_C8C6C506E0704780 ON cooking_tools_recipes (cooking_tools_id)');
        $this->addSql('CREATE INDEX IDX_C8C6C506FDF2B1FA ON cooking_tools_recipes (recipes_id)');
        $this->addSql('CREATE TABLE steps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, description CLOB NOT NULL, spot INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_34220A7259D8A214 ON steps (recipe_id)');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_4B60114FF6859C8C ON ingredients (unity_id)');
        $this->addSql('CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE tag_recipes (tag_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipes_id))');
        $this->addSql('CREATE INDEX IDX_9158CF1FBAD26311 ON tag_recipes (tag_id)');
        $this->addSql('CREATE INDEX IDX_9158CF1FFDF2B1FA ON tag_recipes (recipes_id)');
        $this->addSql('CREATE TABLE recipes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, time_cook INTEGER NOT NULL, preparation_time INTEGER NOT NULL, price INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, comment CLOB NOT NULL)');
        $this->addSql('CREATE TABLE reviews_recipes (reviews_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(reviews_id, recipes_id))');
        $this->addSql('CREATE INDEX IDX_90A6FB748092D97F ON reviews_recipes (reviews_id)');
        $this->addSql('CREATE INDEX IDX_90A6FB74FDF2B1FA ON reviews_recipes (recipes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE unity');
        $this->addSql('DROP TABLE cooking_tools');
        $this->addSql('DROP TABLE cooking_tools_recipes');
        $this->addSql('DROP TABLE steps');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_recipes');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE reviews_recipes');
    }
}
