<?php

declare(strict_types=1);

namespace App\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125111031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE students_images (image_id VARCHAR(255) NOT NULL, student_id VARCHAR(255) NOT NULL, INDEX IDX_5AC39B083DA5256D (image_id), INDEX IDX_5AC39B08CB944F1A (student_id), PRIMARY KEY(image_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grave_images (student_id VARCHAR(255) NOT NULL, image_id VARCHAR(255) NOT NULL, INDEX IDX_20865583CB944F1A (student_id), INDEX IDX_208655833DA5256D (image_id), PRIMARY KEY(student_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_images ADD CONSTRAINT FK_5AC39B083DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE students_images ADD CONSTRAINT FK_5AC39B08CB944F1A FOREIGN KEY (student_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE grave_images ADD CONSTRAINT FK_20865583CB944F1A FOREIGN KEY (student_id) REFERENCES grave (id)');
        $this->addSql('ALTER TABLE grave_images ADD CONSTRAINT FK_208655833DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE students_images DROP FOREIGN KEY FK_5AC39B083DA5256D');
        $this->addSql('ALTER TABLE students_images DROP FOREIGN KEY FK_5AC39B08CB944F1A');
        $this->addSql('ALTER TABLE grave_images DROP FOREIGN KEY FK_20865583CB944F1A');
        $this->addSql('ALTER TABLE grave_images DROP FOREIGN KEY FK_208655833DA5256D');
        $this->addSql('DROP TABLE students_images');
        $this->addSql('DROP TABLE grave_images');
    }
}
