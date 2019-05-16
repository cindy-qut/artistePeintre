<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513142145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE types ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE types ADD CONSTRAINT FK_593089303DA5256D FOREIGN KEY (image_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_593089303DA5256D ON types (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE types DROP FOREIGN KEY FK_593089303DA5256D');
        $this->addSql('DROP INDEX UNIQ_593089303DA5256D ON types');
        $this->addSql('ALTER TABLE types DROP image_id');
    }
}
