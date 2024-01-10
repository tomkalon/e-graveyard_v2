<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109132040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', value INT NOT NULL, currency VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, validity_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_grave (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', grave_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_76E7E855E439654A (grave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_grave ADD CONSTRAINT FK_76E7E855E439654A FOREIGN KEY (grave_id) REFERENCES grave (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE payment_grave ADD CONSTRAINT FK_76E7E855BF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grave DROP paid');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_grave DROP FOREIGN KEY FK_76E7E855E439654A');
        $this->addSql('ALTER TABLE payment_grave DROP FOREIGN KEY FK_76E7E855BF396750');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_grave');
        $this->addSql('ALTER TABLE grave ADD paid DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
