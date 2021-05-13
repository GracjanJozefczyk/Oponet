<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506205315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tire_brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_fuel_efficiency (id INT AUTO_INCREMENT NOT NULL, fuel_efficiency VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_height (id INT AUTO_INCREMENT NOT NULL, height INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_load_index (id INT AUTO_INCREMENT NOT NULL, load_index VARCHAR(10) NOT NULL, kg INT NOT NULL, lbs INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, vehicle_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, season VARCHAR(255) NOT NULL, INDEX IDX_377CB02244F5D008 (brand_id), INDEX IDX_377CB022DA3FD1FC (vehicle_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_noise_level (id INT AUTO_INCREMENT NOT NULL, noise_level VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_product (id INT AUTO_INCREMENT NOT NULL, width_id INT NOT NULL, height_id INT NOT NULL, rim_size_id INT NOT NULL, load_index_id INT NOT NULL, speed_rating_id INT NOT NULL, noise_level_id INT NOT NULL, fuel_efficiency_id INT NOT NULL, wet_grip_id INT NOT NULL, price INT NOT NULL, quantity INT NOT NULL, year INT NOT NULL, run_on_flat TINYINT(1) NOT NULL, reinforced TINYINT(1) NOT NULL, INDEX IDX_51687FAE253C865B (width_id), INDEX IDX_51687FAE4679B87C (height_id), INDEX IDX_51687FAE15F085A4 (rim_size_id), INDEX IDX_51687FAEC4571803 (load_index_id), INDEX IDX_51687FAECD99B135 (speed_rating_id), INDEX IDX_51687FAECDF31B33 (noise_level_id), INDEX IDX_51687FAE7A457CCE (fuel_efficiency_id), INDEX IDX_51687FAEC4FF3D38 (wet_grip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_rim_size (id INT AUTO_INCREMENT NOT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_speed_rating (id INT AUTO_INCREMENT NOT NULL, speed_rating VARCHAR(10) NOT NULL, kmh INT NOT NULL, mph INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_wet_grip (id INT AUTO_INCREMENT NOT NULL, wet_grip VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tire_width (id INT AUTO_INCREMENT NOT NULL, width INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tire_model ADD CONSTRAINT FK_377CB02244F5D008 FOREIGN KEY (brand_id) REFERENCES tire_brand (id)');
        $this->addSql('ALTER TABLE tire_model ADD CONSTRAINT FK_377CB022DA3FD1FC FOREIGN KEY (vehicle_type_id) REFERENCES vehicle_type (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAE253C865B FOREIGN KEY (width_id) REFERENCES tire_width (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAE4679B87C FOREIGN KEY (height_id) REFERENCES tire_height (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAE15F085A4 FOREIGN KEY (rim_size_id) REFERENCES tire_rim_size (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAEC4571803 FOREIGN KEY (load_index_id) REFERENCES tire_load_index (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAECD99B135 FOREIGN KEY (speed_rating_id) REFERENCES tire_speed_rating (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAECDF31B33 FOREIGN KEY (noise_level_id) REFERENCES tire_noise_level (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAE7A457CCE FOREIGN KEY (fuel_efficiency_id) REFERENCES tire_fuel_efficiency (id)');
        $this->addSql('ALTER TABLE tire_product ADD CONSTRAINT FK_51687FAEC4FF3D38 FOREIGN KEY (wet_grip_id) REFERENCES tire_wet_grip (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tire_model DROP FOREIGN KEY FK_377CB02244F5D008');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAE7A457CCE');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAE4679B87C');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAEC4571803');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAECDF31B33');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAE15F085A4');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAECD99B135');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAEC4FF3D38');
        $this->addSql('ALTER TABLE tire_product DROP FOREIGN KEY FK_51687FAE253C865B');
        $this->addSql('ALTER TABLE tire_model DROP FOREIGN KEY FK_377CB022DA3FD1FC');
        $this->addSql('DROP TABLE tire_brand');
        $this->addSql('DROP TABLE tire_fuel_efficiency');
        $this->addSql('DROP TABLE tire_height');
        $this->addSql('DROP TABLE tire_load_index');
        $this->addSql('DROP TABLE tire_model');
        $this->addSql('DROP TABLE tire_noise_level');
        $this->addSql('DROP TABLE tire_product');
        $this->addSql('DROP TABLE tire_rim_size');
        $this->addSql('DROP TABLE tire_speed_rating');
        $this->addSql('DROP TABLE tire_wet_grip');
        $this->addSql('DROP TABLE tire_width');
        $this->addSql('DROP TABLE vehicle_type');
    }
}
