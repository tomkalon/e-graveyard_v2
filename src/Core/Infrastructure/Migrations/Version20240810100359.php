<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240810100359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person ADD born_date_only_year TINYINT(1) DEFAULT NULL, ADD death_date_only_year TINYINT(1) DEFAULT NULL, CHANGE born_date born_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE death_date death_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP born_date_only_year, DROP death_date_only_year, CHANGE born_date born_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE death_date death_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
