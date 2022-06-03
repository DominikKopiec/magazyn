<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601155949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, depot_id INT NOT NULL, article_id INT DEFAULT NULL, unit_id INT NOT NULL, code VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, vat DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_7B00651C8510D4DE (depot_id), INDEX IDX_7B00651C7294869C (article_id), INDEX IDX_7B00651CF8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C8510D4DE FOREIGN KEY (depot_id) REFERENCES depots (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C7294869C FOREIGN KEY (article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CF8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE status');
    }
}
