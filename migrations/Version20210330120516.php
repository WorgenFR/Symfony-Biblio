<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330120516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rayon_categorie (rayon_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY (rayon_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_EAB521F1D3202E52 ON rayon_categorie (rayon_id)');
        $this->addSql('CREATE INDEX IDX_EAB521F1BCF5E72D ON rayon_categorie (categorie_id)');
        $this->addSql('ALTER TABLE rayon_categorie ADD CONSTRAINT FK_EAB521F1D3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rayon_categorie ADD CONSTRAINT FK_EAB521F1BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
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
        $this->addSql('DROP TABLE rayon_categorie');
    }
}
