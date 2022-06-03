<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601165236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_to_depot (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, depot_id INT NOT NULL, UNIQUE INDEX UNIQ_AC255E8CA76ED395 (user_id), UNIQUE INDEX UNIQ_AC255E8C8510D4DE (depot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_to_depot ADD CONSTRAINT FK_AC255E8CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_to_depot ADD CONSTRAINT FK_AC255E8C8510D4DE FOREIGN KEY (depot_id) REFERENCES depots (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_to_depot');
    }
}
