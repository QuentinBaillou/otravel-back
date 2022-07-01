<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302095237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destinations ADD picture2 LONGTEXT DEFAULT NULL, ADD picture3 LONGTEXT DEFAULT NULL, ADD picture4 LONGTEXT DEFAULT NULL, ADD picture5 LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE transports CHANGE way way VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destinations DROP picture2, DROP picture3, DROP picture4, DROP picture5');
        $this->addSql('ALTER TABLE transports CHANGE way way VARCHAR(25) NOT NULL');
    }
}
