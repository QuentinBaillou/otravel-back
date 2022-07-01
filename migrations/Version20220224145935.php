<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224145935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destinations_landscapes (destinations_id INT NOT NULL, landscapes_id INT NOT NULL, INDEX IDX_D75A7B8A912C90D4 (destinations_id), INDEX IDX_D75A7B8AF295E5C1 (landscapes_id), PRIMARY KEY(destinations_id, landscapes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destinations_seasons (destinations_id INT NOT NULL, seasons_id INT NOT NULL, INDEX IDX_FAC960E7912C90D4 (destinations_id), INDEX IDX_FAC960E716EB9F66 (seasons_id), PRIMARY KEY(destinations_id, seasons_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destinations_transports (destinations_id INT NOT NULL, transports_id INT NOT NULL, INDEX IDX_9CFCE4DF912C90D4 (destinations_id), INDEX IDX_9CFCE4DF518E99D9 (transports_id), PRIMARY KEY(destinations_id, transports_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations_landscapes ADD CONSTRAINT FK_D75A7B8A912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_landscapes ADD CONSTRAINT FK_D75A7B8AF295E5C1 FOREIGN KEY (landscapes_id) REFERENCES landscapes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_seasons ADD CONSTRAINT FK_FAC960E7912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_seasons ADD CONSTRAINT FK_FAC960E716EB9F66 FOREIGN KEY (seasons_id) REFERENCES seasons (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_transports ADD CONSTRAINT FK_9CFCE4DF912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_transports ADD CONSTRAINT FK_9CFCE4DF518E99D9 FOREIGN KEY (transports_id) REFERENCES transports (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE destinations_landscapes');
        $this->addSql('DROP TABLE destinations_seasons');
        $this->addSql('DROP TABLE destinations_transports');
    }
}
