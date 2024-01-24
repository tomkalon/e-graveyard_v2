<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123194316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_grave (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_8B2D6ED0E439654A (grave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', value INT NOT NULL, currency VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, validity_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_grave (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_76E7E855E439654A (grave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0BF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_grave ADD CONSTRAINT FK_76E7E855E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE payment_grave ADD CONSTRAINT FK_76E7E855BF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610B0C855CA');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610E439654A');
        $this->addSql('DROP INDEX IDX_8C9F3610E439654A ON file');
        $this->addSql('DROP INDEX IDX_8C9F3610B0C855CA ON file');
        $this->addSql('ALTER TABLE file ADD discr VARCHAR(255) NOT NULL, DROP grave_id, DROP graveyard_id, DROP `primary`');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('ALTER TABLE grave ADD main_image_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP paid');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7E4873418 FOREIGN KEY (main_image_id) REFERENCES file_grave (id)');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_21AEDEE7E4873418 ON grave (main_image_id)');
        $this->addSql('CREATE UNIQUE INDEX unique_entity ON grave (sector, row, number, graveyard_id)');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7E4873418');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0E439654A');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0BF396750');
        $this->addSql('ALTER TABLE payment_grave DROP FOREIGN KEY FK_76E7E855E439654A');
        $this->addSql('ALTER TABLE payment_grave DROP FOREIGN KEY FK_76E7E855BF396750');
        $this->addSql('DROP TABLE file_grave');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_grave');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grave DROP FOREIGN KEY FK_21AEDEE7B0C855CA');
        $this->addSql('DROP INDEX UNIQ_21AEDEE7E4873418 ON grave');
        $this->addSql('DROP INDEX unique_entity ON grave');
        $this->addSql('ALTER TABLE grave ADD paid DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP main_image_id');
        $this->addSql('ALTER TABLE grave ADD CONSTRAINT FK_21AEDEE7B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file ADD grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD graveyard_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD `primary` TINYINT(1) DEFAULT NULL, DROP discr');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610B0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8C9F3610E439654A ON file (grave_id)');
        $this->addSql('CREATE INDEX IDX_8C9F3610B0C855CA ON file (graveyard_id)');
    }
}
