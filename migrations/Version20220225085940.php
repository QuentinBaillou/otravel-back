<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220225085940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destinations_tags (destinations_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_138A80C3912C90D4 (destinations_id), INDEX IDX_138A80C38D7B4FB4 (tags_id), PRIMARY KEY(destinations_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nights (id INT AUTO_INCREMENT NOT NULL, night_nb INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations_tags ADD CONSTRAINT FK_138A80C3912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_tags ADD CONSTRAINT FK_138A80C38D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations ADD provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3A53A8AA FOREIGN KEY (provider_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX IDX_2D3343C3A53A8AA ON destinations (provider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE destinations_tags');
        $this->addSql('DROP TABLE nights');
        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3A53A8AA');
        $this->addSql('DROP INDEX IDX_2D3343C3A53A8AA ON destinations');
        $this->addSql('ALTER TABLE destinations DROP provider_id');
    }
}
