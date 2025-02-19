<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250210155047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A5697F554');
        $this->addSql('ALTER TABLE products CHANGE id_products id_products INT NOT NULL');
        $this->addSql('ALTER TABLE products CHANGE id_category id_category INT NOT NULL');
        $this->addSql('ALTER TABLE products CHANGE cover cover TEXT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A5697F554 FOREIGN KEY (id_category) REFERENCES category (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A1075092D FOREIGN KEY (id_badge) REFERENCES badge (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A5697F554 ON products (id_category)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A1075092D ON products (id_badge)');
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT NOT NULL, CHANGE first_name first_name VARCHAR(50) NOT NULL, CHANGE last_name last_name VARCHAR(255), CHANGE username username VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {   
        // $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A5697F554');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A1075092D');
        $this->addSql('DROP INDEX IDX_B3BA5A5A5697F554 ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A1075092D ON products');
        $this->addSql('ALTER TABLE products CHANGE id_category id_category INT DEFAULT NULL, CHANGE id_products id_products INT DEFAULT NULL, CHANGE cover cover TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT DEFAULT NULL, CHANGE first_name first_name VARCHAR(50) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255), CHANGE username username VARCHAR(50) DEFAULT NULL');
    }
}
