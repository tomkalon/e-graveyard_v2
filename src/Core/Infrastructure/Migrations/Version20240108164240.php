<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108164240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
    }
}
