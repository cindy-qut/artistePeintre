<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190510133640 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvres DROP INDEX FK_413EEE3E3DA5256D, ADD UNIQUE INDEX UNIQ_413EEE3E3DA5256D (image_id)');
        $this->addSql('ALTER TABLE oeuvres ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3EFF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3EC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('CREATE INDEX IDX_413EEE3EFF25611A ON oeuvres (taille_id)');
        $this->addSql('CREATE INDEX IDX_413EEE3EC54C8C93 ON oeuvres (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oeuvres DROP INDEX UNIQ_413EEE3E3DA5256D, ADD INDEX FK_413EEE3E3DA5256D (image_id)');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3EFF25611A');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3EC54C8C93');
        $this->addSql('DROP INDEX IDX_413EEE3EFF25611A ON oeuvres');
        $this->addSql('DROP INDEX IDX_413EEE3EC54C8C93 ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres DROP type_id');
    }
}
