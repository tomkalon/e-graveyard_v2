<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231109193331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave ADD sector INT DEFAULT NULL, ADD row INT DEFAULT NULL, ADD number INT DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD paid DATE DEFAULT NULL, ADD position_x VARCHAR(255) DEFAULT NULL, ADD position_y VARCHAR(255) DEFAULT NULL, CHANGE id id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave DROP sector, DROP row, DROP number, DROP image, DROP paid, DROP position_x, DROP position_y, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
