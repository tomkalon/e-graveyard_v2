<?php

declare(strict_types=1);

namespace App\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125164325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE file_grave (grave_id VARCHAR(255) NOT NULL, image_id VARCHAR(255) NOT NULL, INDEX IDX_8B2D6ED0E439654A (grave_id), INDEX IDX_8B2D6ED03DA5256D (image_id), PRIMARY KEY(grave_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graveyard (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_graveyard (graveyard_id VARCHAR(255) NOT NULL, image_id VARCHAR(255) NOT NULL, INDEX IDX_17ED70DCB0C855CA (graveyard_id), INDEX IDX_17ED70DC3DA5256D (image_id), PRIMARY KEY(graveyard_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED0E439654A FOREIGN KEY (grave_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE file_grave ADD CONSTRAINT FK_8B2D6ED03DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DCB0C855CA FOREIGN KEY (graveyard_id) REFERENCES graveyard (id)');
        $this->addSql('ALTER TABLE file_graveyard ADD CONSTRAINT FK_17ED70DC3DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE students_images DROP FOREIGN KEY FK_5AC39B083DA5256D');
        $this->addSql('ALTER TABLE students_images DROP FOREIGN KEY FK_5AC39B08CB944F1A');
        $this->addSql('ALTER TABLE grave_images DROP FOREIGN KEY FK_20865583CB944F1A');
        $this->addSql('ALTER TABLE grave_images DROP FOREIGN KEY FK_208655833DA5256D');
        $this->addSql('DROP TABLE students_images');
        $this->addSql('DROP TABLE grave_images');
        $this->addSql('ALTER TABLE file DROP created, DROP updated');
        $this->addSql('ALTER TABLE grave ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP created, DROP updated, CHANGE paid paid DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE students_images (image_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, student_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5AC39B083DA5256D (image_id), INDEX IDX_5AC39B08CB944F1A (student_id), PRIMARY KEY(image_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grave_images (student_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_20865583CB944F1A (student_id), INDEX IDX_208655833DA5256D (image_id), PRIMARY KEY(student_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE students_images ADD CONSTRAINT FK_5AC39B083DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE students_images ADD CONSTRAINT FK_5AC39B08CB944F1A FOREIGN KEY (student_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE grave_images ADD CONSTRAINT FK_20865583CB944F1A FOREIGN KEY (student_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE grave_images ADD CONSTRAINT FK_208655833DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED0E439654A');
        $this->addSql('ALTER TABLE file_grave DROP FOREIGN KEY FK_8B2D6ED03DA5256D');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DCB0C855CA');
        $this->addSql('ALTER TABLE file_graveyard DROP FOREIGN KEY FK_17ED70DC3DA5256D');
        $this->addSql('DROP TABLE file_grave');
        $this->addSql('DROP TABLE graveyard');
        $this->addSql('DROP TABLE file_graveyard');
        $this->addSql('ALTER TABLE grave ADD created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME NOT NULL, DROP created_at, CHANGE paid paid DATETIME NOT NULL');
        $this->addSql('ALTER TABLE file ADD created DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated DATETIME NOT NULL');
    }
}
