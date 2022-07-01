<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220303143315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_destinations (user_id INT NOT NULL, destinations_id INT NOT NULL, INDEX IDX_ADFF3FC1A76ED395 (user_id), INDEX IDX_ADFF3FC1912C90D4 (destinations_id), PRIMARY KEY(user_id, destinations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_nights (user_id INT NOT NULL, nights_id INT NOT NULL, INDEX IDX_102608DEA76ED395 (user_id), INDEX IDX_102608DEFB625F0B (nights_id), PRIMARY KEY(user_id, nights_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_destinations ADD CONSTRAINT FK_ADFF3FC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_destinations ADD CONSTRAINT FK_ADFF3FC1912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_nights ADD CONSTRAINT FK_102608DEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_nights ADD CONSTRAINT FK_102608DEFB625F0B FOREIGN KEY (nights_id) REFERENCES nights (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(50) DEFAULT NULL, ADD lastname VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_destinations');
        $this->addSql('DROP TABLE user_nights');
        $this->addSql('ALTER TABLE user DROP firstname, DROP lastname');
    }
}
