<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513100140 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT DEFAULT NULL, biographie LONGTEXT NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_F85A4D4B2C2AC5D3 (translatable_id), UNIQUE INDEX presentation_translation_unique_translation (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE presentation_translation ADD CONSTRAINT FK_F85A4D4B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES presentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3EC54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
        $this->addSql('CREATE INDEX IDX_413EEE3EC54C8C93 ON oeuvres (type_id)');
        $this->addSql('ALTER TABLE oeuvres RENAME INDEX fk_413eee3eff25611a TO IDX_413EEE3EFF25611A');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE presentation_translation DROP FOREIGN KEY FK_F85A4D4B2C2AC5D3');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE presentation_translation');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3EC54C8C93');
        $this->addSql('DROP INDEX IDX_413EEE3EC54C8C93 ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres RENAME INDEX idx_413eee3eff25611a TO FK_413EEE3EFF25611A');
    }
}
