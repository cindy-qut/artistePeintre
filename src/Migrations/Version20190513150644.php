<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190513150644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_images (article_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_8AD829EA7294869C (article_id), INDEX IDX_8AD829EAD44F05E5 (images_id), PRIMARY KEY(article_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_images ADD CONSTRAINT FK_8AD829EA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_images ADD CONSTRAINT FK_8AD829EAD44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images ADD presentation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AAB627E8B FOREIGN KEY (presentation_id) REFERENCES presentation (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AAB627E8B ON images (presentation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_images');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AAB627E8B');
        $this->addSql('DROP INDEX IDX_E01FBE6AAB627E8B ON images');
        $this->addSql('ALTER TABLE images DROP presentation_id');
    }
}
