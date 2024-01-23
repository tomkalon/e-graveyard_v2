<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123192037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('DROP INDEX IDX_8C9F3610B0C855CA ON file');
        $this->addSql('DROP INDEX IDX_8C9F3610E439654A ON file');
        $this->addSql('ALTER TABLE file ADD discr VARCHAR(255) NOT NULL, DROP grave_id, DROP graveyard_id, DROP `primary`');
        $this->addSql('ALTER TABLE grave ADD main_image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7E4873418 FOREIGN KEY (main_image_id) REFERENCES file_grave (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE7E4873418 ON grave (main_image_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_entity ON grave (sector, row, number, graveyard_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7E4873418');
        $this->addSql('DROP INDEX UNIQ_21AEDEE7E4873418 ON grave');
        $this->addSql('DROP INDEX unique_entity ON grave');
        $this->addSql('ALTER TABLE grave DROP main_image_id');
        $this->addSql('ALTER TABLE file ADD grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD graveyard_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD `primary` TINYINT(1) DEFAULT NULL, DROP discr');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_8C9F3610B0C855CA ON file (graveyard_id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610E439654A ON file (grave_id)');
    }
}
