<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329145541 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT IDENTITY NOT NULL, nom NVARCHAR(255) NOT NULL, prenom NVARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, sexe BIT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE categorie (id INT IDENTITY NOT NULL, id_catg INT NOT NULL, lib_catg NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE livre (id INT IDENTITY NOT NULL, rayon_id INT NOT NULL, id_livre INT NOT NULL, titre NVARCHAR(255) NOT NULL, date_parution DATE NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_AC634F99D3202E52 ON livre (rayon_id)');
        $this->addSql('CREATE TABLE livre_auteur (livre_id INT NOT NULL, auteur_id INT NOT NULL, PRIMARY KEY (livre_id, auteur_id))');
        $this->addSql('CREATE INDEX IDX_A11876B537D925CB ON livre_auteur (livre_id)');
        $this->addSql('CREATE INDEX IDX_A11876B560BB6FE6 ON livre_auteur (auteur_id)');
        $this->addSql('CREATE TABLE livre_categorie (livre_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY (livre_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_E61B069E37D925CB ON livre_categorie (livre_id)');
        $this->addSql('CREATE INDEX IDX_E61B069EBCF5E72D ON livre_categorie (categorie_id)');
        $this->addSql('CREATE TABLE rayon (id INT IDENTITY NOT NULL, id_rayon INT NOT NULL, lib_rayon NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99D3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B537D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_auteur ADD CONSTRAINT FK_A11876B560BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie ADD CONSTRAINT FK_E61B069E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie ADD CONSTRAINT FK_E61B069EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE livre_auteur DROP CONSTRAINT FK_A11876B560BB6FE6');
        $this->addSql('ALTER TABLE livre_categorie DROP CONSTRAINT FK_E61B069EBCF5E72D');
        $this->addSql('ALTER TABLE livre_auteur DROP CONSTRAINT FK_A11876B537D925CB');
        $this->addSql('ALTER TABLE livre_categorie DROP CONSTRAINT FK_E61B069E37D925CB');
        $this->addSql('ALTER TABLE livre DROP CONSTRAINT FK_AC634F99D3202E52');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE livre_auteur');
        $this->addSql('DROP TABLE livre_categorie');
        $this->addSql('DROP TABLE rayon');
    }
}
