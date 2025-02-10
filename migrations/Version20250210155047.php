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
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lists (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cover LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, likes INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_8269FA5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lists_products (lists_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_85D7F00F9D26499B (lists_id), INDEX IDX_85D7F00F6C8A81A9 (products_id), PRIMARY KEY(lists_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lists ADD CONSTRAINT FK_8269FA5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE lists_products ADD CONSTRAINT FK_85D7F00F9D26499B FOREIGN KEY (lists_id) REFERENCES lists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lists_products ADD CONSTRAINT FK_85D7F00F6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products CHANGE id_products id_products INT NOT NULL, CHANGE id_category id_category INT NOT NULL, CHANGE cover cover VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A5697F554 FOREIGN KEY (id_category) REFERENCES category (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A1075092D FOREIGN KEY (id_badge) REFERENCES badge (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A5697F554 ON products (id_category)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A1075092D ON products (id_badge)');
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT NOT NULL, CHANGE first_name first_name VARCHAR(50) NOT NULL, CHANGE last_name last_name VARCHAR(50) NOT NULL, CHANGE username username VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lists DROP FOREIGN KEY FK_8269FA5A76ED395');
        $this->addSql('ALTER TABLE lists_products DROP FOREIGN KEY FK_85D7F00F9D26499B');
        $this->addSql('ALTER TABLE lists_products DROP FOREIGN KEY FK_85D7F00F6C8A81A9');
        $this->addSql('DROP TABLE lists');
        $this->addSql('DROP TABLE lists_products');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A5697F554');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A1075092D');
        $this->addSql('DROP INDEX IDX_B3BA5A5A5697F554 ON products');
        $this->addSql('DROP INDEX IDX_B3BA5A5A1075092D ON products');
        $this->addSql('ALTER TABLE products CHANGE id_category id_category INT DEFAULT NULL, CHANGE id_products id_products INT DEFAULT NULL, CHANGE cover cover VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT DEFAULT NULL, CHANGE first_name first_name VARCHAR(50) DEFAULT NULL, CHANGE last_name last_name VARCHAR(50) DEFAULT NULL, CHANGE username username VARCHAR(50) DEFAULT NULL');
    }
}
