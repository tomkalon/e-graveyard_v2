<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240101193914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
    }
}
