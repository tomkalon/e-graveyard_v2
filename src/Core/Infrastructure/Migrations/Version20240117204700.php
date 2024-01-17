<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117204700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE file ADD type VARCHAR(255) DEFAULT NULL, DROP `primary`');
        $this->addSql('ALTER TABLE grave ADD main_image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7E4873418 FOREIGN KEY (main_image_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE7E4873418 ON grave (main_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7E4873418');
        $this->addSql('DROP INDEX UNIQ_21AEDEE7E4873418 ON grave');
        $this->addSql('ALTER TABLE grave DROP main_image_id');
        $this->addSql('ALTER TABLE file ADD `primary` TINYINT(1) DEFAULT NULL, DROP type');
    }
}
