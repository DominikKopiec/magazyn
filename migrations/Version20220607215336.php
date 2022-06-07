<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607215336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651CF8BD700D');
        $this->addSql('DROP INDEX IDX_7B00651CF8BD700D ON status');
        $this->addSql('ALTER TABLE status DROP unit_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE status ADD unit_id INT NOT NULL');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CF8BD700D FOREIGN KEY (unit_id) REFERENCES units (id)');
        $this->addSql('CREATE INDEX IDX_7B00651CF8BD700D ON status (unit_id)');
    }
}
