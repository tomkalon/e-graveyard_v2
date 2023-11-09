<?php

declare(strict_types=1);

namespace App\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109203240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file (id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grave ADD created DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', ADD edited DATE NOT NULL, CHANGE sector sector INT NOT NULL, CHANGE number number INT NOT NULL');
        $this->addSql('ALTER TABLE graveyard CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE person ADD lastname VARCHAR(255) NOT NULL, CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE file');
        $this->addSql('ALTER TABLE person DROP lastname, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE grave DROP created, DROP edited, CHANGE sector sector INT DEFAULT NULL, CHANGE number number INT DEFAULT NULL');
        $this->addSql('ALTER TABLE graveyard CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
