<?php

declare(strict_types=1);

namespace App\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205180556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED093CB796C');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0E439654A');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DC93CB796C');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DCB0C855CA');
        $this->addSql('DROP TABLE file_grave');
        $this->addSql('DROP TABLE file_graveyard');
        $this->addSql('ALTER TABLE file ADD grave_id VARCHAR(255) DEFAULT NULL, ADD graveyard_id VARCHAR(255) DEFAULT NULL, ADD `primary` TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610E439654A ON file (grave_id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610B0C855CA ON file (graveyard_id)');
        $this->addSql('ALTER TABLE grave ADD graveyard_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('CREATE INDEX IDX_21AEDEE7B0C855CA ON grave (graveyard_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_grave (grave_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, file_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8B2D6ED093CB796C (file_id), INDEX IDX_8B2D6ED0E439654A (grave_id), PRIMARY KEY(file_id, grave_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE file_graveyard (graveyard_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, file_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_17ED70DCB0C855CA (graveyard_id), INDEX IDX_17ED70DC93CB796C (file_id), PRIMARY KEY(file_id, graveyard_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED093CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DC93CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DCB0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('DROP INDEX IDX_21AEDEE7B0C855CA ON grave');
        $this->addSql('ALTER TABLE grave DROP graveyard_id');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('DROP INDEX IDX_8C9F3610E439654A ON file');
        $this->addSql('DROP INDEX IDX_8C9F3610B0C855CA ON file');
        $this->addSql('ALTER TABLE file DROP grave_id, DROP graveyard_id, DROP `primary`');
    }
}
