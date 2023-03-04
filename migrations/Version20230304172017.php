<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304172017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dessert ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE drink ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE entree ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE plat ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP slug');
        $this->addSql('ALTER TABLE dessert DROP slug');
        $this->addSql('ALTER TABLE drink DROP slug');
        $this->addSql('ALTER TABLE entree DROP slug');
        $this->addSql('ALTER TABLE plat DROP slug');
    }
}
