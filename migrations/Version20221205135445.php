<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205135445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contest ADD winner_id INT DEFAULT NULL, DROP star_date');
        $this->addSql('ALTER TABLE player_contest ADD CONSTRAINT FK_605DA3F099E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE player_contest ADD CONSTRAINT FK_605DA3F01CD0F0DE FOREIGN KEY (contest_id) REFERENCES contest (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contest ADD star_date DATETIME NOT NULL, DROP winner_id');
        $this->addSql('ALTER TABLE player_contest DROP FOREIGN KEY FK_605DA3F099E6F5DF');
        $this->addSql('ALTER TABLE player_contest DROP FOREIGN KEY FK_605DA3F01CD0F0DE');
    }
}
