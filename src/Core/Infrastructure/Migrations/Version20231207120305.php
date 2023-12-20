<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231207120305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', graveyard_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, `primary` TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_8C9F3610E439654A (grave_id), INDEX IDX_8C9F3610B0C855CA (graveyard_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grave (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', graveyard_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', sector INT NOT NULL, row INT DEFAULT NULL, number INT NOT NULL, position_x VARCHAR(255) NOT NULL, position_y VARCHAR(255) NOT NULL, paid DATETIME DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_21AEDEE7B0C855CA (graveyard_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graveyard (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, born_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', death_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_34DCD176E439654A (grave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(60) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', username VARCHAR(50) NOT NULL, is_verified TINYINT(1) DEFAULT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE grave');
        $this->addSql('DROP TABLE graveyard');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE user');
    }
}
