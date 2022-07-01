<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225090657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destinations_users (destinations_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_C49F850A912C90D4 (destinations_id), INDEX IDX_C49F850A67B3B43D (users_id), PRIMARY KEY(destinations_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations_users ADD CONSTRAINT FK_C49F850A912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_users ADD CONSTRAINT FK_C49F850A67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE destinations_users');
    }
}
