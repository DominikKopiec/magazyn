<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601163716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_to_depot (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_to_depot_users (user_to_depot_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_37641774E15283E5 (user_to_depot_id), INDEX IDX_3764177467B3B43D (users_id), PRIMARY KEY(user_to_depot_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_to_depot_users ADD CONSTRAINT FK_37641774E15283E5 FOREIGN KEY (user_to_depot_id) REFERENCES user_to_depot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_to_depot_users ADD CONSTRAINT FK_3764177467B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_to_depot_users DROP FOREIGN KEY FK_37641774E15283E5');
        $this->addSql('DROP TABLE user_to_depot');
        $this->addSql('DROP TABLE user_to_depot_users');
    }
}
