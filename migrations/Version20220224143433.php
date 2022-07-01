<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224143433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destinations (id INT AUTO_INCREMENT NOT NULL, state VARCHAR(65) NOT NULL, surname VARCHAR(65) NOT NULL, picture LONGTEXT NOT NULL, summary LONGTEXT NOT NULL, extract LONGTEXT NOT NULL, pros LONGTEXT NOT NULL, created_at DATE NOT NULL, updated_at DATE NOT NULL, price_per_night INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE landscapes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE providers (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(65) DEFAULT NULL, url VARCHAR(65) DEFAULT NULL, created_at DATE DEFAULT NULL, updated_at DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seasons (id INT AUTO_INCREMENT NOT NULL, season VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transports (id INT AUTO_INCREMENT NOT NULL, way VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, role VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE destinations');
        $this->addSql('DROP TABLE landscapes');
        $this->addSql('DROP TABLE providers');
        $this->addSql('DROP TABLE seasons');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE transports');
        $this->addSql('DROP TABLE users');
    }
}
