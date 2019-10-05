<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191005151334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE recipes_ingredients (recipes_id INTEGER NOT NULL, ingredients_id INTEGER NOT NULL, PRIMARY KEY(recipes_id, ingredients_id))');
        $this->addSql('CREATE INDEX IDX_761206B0FDF2B1FA ON recipes_ingredients (recipes_id)');
        $this->addSql('CREATE INDEX IDX_761206B03EC4DCE ON recipes_ingredients (ingredients_id)');
        $this->addSql('DROP INDEX IDX_C8C6C506E0704780');
        $this->addSql('DROP INDEX IDX_C8C6C506FDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cooking_tools_recipes AS SELECT cooking_tools_id, recipes_id FROM cooking_tools_recipes');
        $this->addSql('DROP TABLE cooking_tools_recipes');
        $this->addSql('CREATE TABLE cooking_tools_recipes (cooking_tools_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(cooking_tools_id, recipes_id), CONSTRAINT FK_C8C6C506E0704780 FOREIGN KEY (cooking_tools_id) REFERENCES cooking_tools (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C8C6C506FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO cooking_tools_recipes (cooking_tools_id, recipes_id) SELECT cooking_tools_id, recipes_id FROM __temp__cooking_tools_recipes');
        $this->addSql('DROP TABLE __temp__cooking_tools_recipes');
        $this->addSql('CREATE INDEX IDX_C8C6C506E0704780 ON cooking_tools_recipes (cooking_tools_id)');
        $this->addSql('CREATE INDEX IDX_C8C6C506FDF2B1FA ON cooking_tools_recipes (recipes_id)');
        $this->addSql('DROP INDEX IDX_34220A7259D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__steps AS SELECT id, recipe_id, description, spot FROM steps');
        $this->addSql('DROP TABLE steps');
        $this->addSql('CREATE TABLE steps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, description CLOB NOT NULL COLLATE BINARY, spot INTEGER NOT NULL, CONSTRAINT FK_34220A7259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO steps (id, recipe_id, description, spot) SELECT id, recipe_id, description, spot FROM __temp__steps');
        $this->addSql('DROP TABLE __temp__steps');
        $this->addSql('CREATE INDEX IDX_34220A7259D8A214 ON steps (recipe_id)');
        $this->addSql('DROP INDEX IDX_4B60114FF6859C8C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, unity_id, name, quantity, picture FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, quantity INTEGER NOT NULL, picture VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_4B60114FF6859C8C FOREIGN KEY (unity_id) REFERENCES unity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredients (id, unity_id, name, quantity, picture) SELECT id, unity_id, name, quantity, picture FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE INDEX IDX_4B60114FF6859C8C ON ingredients (unity_id)');
        $this->addSql('DROP INDEX IDX_9158CF1FBAD26311');
        $this->addSql('DROP INDEX IDX_9158CF1FFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipes AS SELECT tag_id, recipes_id FROM tag_recipes');
        $this->addSql('DROP TABLE tag_recipes');
        $this->addSql('CREATE TABLE tag_recipes (tag_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipes_id), CONSTRAINT FK_9158CF1FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9158CF1FFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tag_recipes (tag_id, recipes_id) SELECT tag_id, recipes_id FROM __temp__tag_recipes');
        $this->addSql('DROP TABLE __temp__tag_recipes');
        $this->addSql('CREATE INDEX IDX_9158CF1FBAD26311 ON tag_recipes (tag_id)');
        $this->addSql('CREATE INDEX IDX_9158CF1FFDF2B1FA ON tag_recipes (recipes_id)');
        $this->addSql('DROP INDEX IDX_90A6FB748092D97F');
        $this->addSql('DROP INDEX IDX_90A6FB74FDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews_recipes AS SELECT reviews_id, recipes_id FROM reviews_recipes');
        $this->addSql('DROP TABLE reviews_recipes');
        $this->addSql('CREATE TABLE reviews_recipes (reviews_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(reviews_id, recipes_id), CONSTRAINT FK_90A6FB748092D97F FOREIGN KEY (reviews_id) REFERENCES reviews (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_90A6FB74FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reviews_recipes (reviews_id, recipes_id) SELECT reviews_id, recipes_id FROM __temp__reviews_recipes');
        $this->addSql('DROP TABLE __temp__reviews_recipes');
        $this->addSql('CREATE INDEX IDX_90A6FB748092D97F ON reviews_recipes (reviews_id)');
        $this->addSql('CREATE INDEX IDX_90A6FB74FDF2B1FA ON reviews_recipes (recipes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE recipes_ingredients');
        $this->addSql('DROP INDEX IDX_C8C6C506E0704780');
        $this->addSql('DROP INDEX IDX_C8C6C506FDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__cooking_tools_recipes AS SELECT cooking_tools_id, recipes_id FROM cooking_tools_recipes');
        $this->addSql('DROP TABLE cooking_tools_recipes');
        $this->addSql('CREATE TABLE cooking_tools_recipes (cooking_tools_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(cooking_tools_id, recipes_id))');
        $this->addSql('INSERT INTO cooking_tools_recipes (cooking_tools_id, recipes_id) SELECT cooking_tools_id, recipes_id FROM __temp__cooking_tools_recipes');
        $this->addSql('DROP TABLE __temp__cooking_tools_recipes');
        $this->addSql('CREATE INDEX IDX_C8C6C506E0704780 ON cooking_tools_recipes (cooking_tools_id)');
        $this->addSql('CREATE INDEX IDX_C8C6C506FDF2B1FA ON cooking_tools_recipes (recipes_id)');
        $this->addSql('DROP INDEX IDX_4B60114FF6859C8C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredients AS SELECT id, unity_id, name, quantity, picture FROM ingredients');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, quantity INTEGER NOT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO ingredients (id, unity_id, name, quantity, picture) SELECT id, unity_id, name, quantity, picture FROM __temp__ingredients');
        $this->addSql('DROP TABLE __temp__ingredients');
        $this->addSql('CREATE INDEX IDX_4B60114FF6859C8C ON ingredients (unity_id)');
        $this->addSql('DROP INDEX IDX_90A6FB748092D97F');
        $this->addSql('DROP INDEX IDX_90A6FB74FDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews_recipes AS SELECT reviews_id, recipes_id FROM reviews_recipes');
        $this->addSql('DROP TABLE reviews_recipes');
        $this->addSql('CREATE TABLE reviews_recipes (reviews_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(reviews_id, recipes_id))');
        $this->addSql('INSERT INTO reviews_recipes (reviews_id, recipes_id) SELECT reviews_id, recipes_id FROM __temp__reviews_recipes');
        $this->addSql('DROP TABLE __temp__reviews_recipes');
        $this->addSql('CREATE INDEX IDX_90A6FB748092D97F ON reviews_recipes (reviews_id)');
        $this->addSql('CREATE INDEX IDX_90A6FB74FDF2B1FA ON reviews_recipes (recipes_id)');
        $this->addSql('DROP INDEX IDX_34220A7259D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__steps AS SELECT id, recipe_id, description, spot FROM steps');
        $this->addSql('DROP TABLE steps');
        $this->addSql('CREATE TABLE steps (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER DEFAULT NULL, description CLOB NOT NULL, spot INTEGER NOT NULL)');
        $this->addSql('INSERT INTO steps (id, recipe_id, description, spot) SELECT id, recipe_id, description, spot FROM __temp__steps');
        $this->addSql('DROP TABLE __temp__steps');
        $this->addSql('CREATE INDEX IDX_34220A7259D8A214 ON steps (recipe_id)');
        $this->addSql('DROP INDEX IDX_9158CF1FBAD26311');
        $this->addSql('DROP INDEX IDX_9158CF1FFDF2B1FA');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tag_recipes AS SELECT tag_id, recipes_id FROM tag_recipes');
        $this->addSql('DROP TABLE tag_recipes');
        $this->addSql('CREATE TABLE tag_recipes (tag_id INTEGER NOT NULL, recipes_id INTEGER NOT NULL, PRIMARY KEY(tag_id, recipes_id))');
        $this->addSql('INSERT INTO tag_recipes (tag_id, recipes_id) SELECT tag_id, recipes_id FROM __temp__tag_recipes');
        $this->addSql('DROP TABLE __temp__tag_recipes');
        $this->addSql('CREATE INDEX IDX_9158CF1FBAD26311 ON tag_recipes (tag_id)');
        $this->addSql('CREATE INDEX IDX_9158CF1FFDF2B1FA ON tag_recipes (recipes_id)');
    }
}
