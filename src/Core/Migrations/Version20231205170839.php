<?php

declare(strict_types=1);

namespace App\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205170839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id VARCHAR(255) NOT NULL, grave_id VARCHAR(255) DEFAULT NULL, firstname VARCHAR(60) NOT NULL, lastname VARCHAR(60) NOT NULL, born_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', death_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_34DCD176E439654A (grave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED03DA5256D');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0E439654A');
        $this->addSql('DROP INDEX IDX_8B2D6ED03DA5256D ON file_grave');
        $this->addSql('DROP INDEX `primary` ON file_grave');
        $this->addSql('ALTER TABLE file_grave CHANGE image_id file_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED093CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8B2D6ED093CB796C ON file_grave (file_id)');
        $this->addSql('ALTER TABLE file_grave ADD PRIMARY KEY (file_id, grave_id)');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DC3DA5256D');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DCB0C855CA');
        $this->addSql('DROP INDEX IDX_17ED70DC3DA5256D ON file_graveyard');
        $this->addSql('DROP INDEX `primary` ON file_graveyard');
        $this->addSql('ALTER TABLE file_graveyard CHANGE image_id file_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DC93CB796C FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DCB0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_17ED70DC93CB796C ON file_graveyard (file_id)');
        $this->addSql('ALTER TABLE file_graveyard ADD PRIMARY KEY (file_id, graveyard_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176E439654A');
        $this->addSql('DROP TABLE person');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED093CB796C');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0E439654A');
        $this->addSql('DROP INDEX IDX_8B2D6ED093CB796C ON file_grave');
        $this->addSql('DROP INDEX `PRIMARY` ON file_grave');
        $this->addSql('ALTER TABLE file_grave CHANGE file_id image_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED03DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
        $this->addSql('CREATE INDEX IDX_8B2D6ED03DA5256D ON file_grave (image_id)');
        $this->addSql('ALTER TABLE file_grave ADD PRIMARY KEY (grave_id, image_id)');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DC93CB796C');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DCB0C855CA');
        $this->addSql('DROP INDEX IDX_17ED70DC93CB796C ON file_graveyard');
        $this->addSql('DROP INDEX `PRIMARY` ON file_graveyard');
        $this->addSql('ALTER TABLE file_graveyard CHANGE file_id image_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DC3DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DCB0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('CREATE INDEX IDX_17ED70DC3DA5256D ON file_graveyard (image_id)');
        $this->addSql('ALTER TABLE file_graveyard ADD PRIMARY KEY (graveyard_id, image_id)');
    }
}
