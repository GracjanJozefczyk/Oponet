<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210513140645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire_product ADD model_id INT NOT NULL');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAE7975B7E7 FOREIGN KEY (model_id) REFERENCES tire_model (id)');
        $this->addSql('CREATE INDEX IDX_51687FAE7975B7E7 ON tire_product (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAE7975B7E7');
        $this->addSql('DROP INDEX IDX_51687FAE7975B7E7 ON tire_product');
        $this->addSql('ALTER TABLE tire_product DROP model_id');
    }
}
