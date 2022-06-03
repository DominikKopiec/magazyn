<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601164404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_to_depot (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, depot_id_id INT NOT NULL, INDEX IDX_AC255E8C9D86650F (user_id_id), INDEX IDX_AC255E8C19B5CDF0 (depot_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_to_depot ADD CONSTRAINT FK_AC255E8C9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_to_depot ADD CONSTRAINT FK_AC255E8C19B5CDF0 FOREIGN KEY (depot_id_id) REFERENCES depots (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_to_depot');
    }
}
