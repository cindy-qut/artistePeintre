<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510085940 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvres ADD image_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E3DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_413EEE3E3DA5256D ON oeuvres (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E3DA5256D');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP INDEX UNIQ_413EEE3E3DA5256D ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres DROP image_id');
    }
}
