<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250203133422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE badge (id INT AUTO_INCREMENT NOT NULL, id_badge INT NOT NULL, code VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, id_category INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, id_products INT NOT NULL, title VARCHAR(255) NOT NULL, id_category INT NOT NULL, id_badge INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, id_review INT NOT NULL, id_user INT NOT NULL, id_product INT NOT NULL, rating VARCHAR(255) NOT NULL, review_text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, id_tag INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, id_users INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE lists (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, cover TEXT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, website LONGTEXT DEFAULT NULL, likes INT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_8269FA5A76ED395 (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE lists_products (id INT AUTO_INCREMENT NOT NULL, lists_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_85D7F00F9D26499B (lists_id), INDEX IDX_85D7F00F6C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB");
        $this->addSql("CREATE TABLE alternatives (id INT AUTO_INCREMENT NOT NULL, id_products INT DEFAULT NULL, id_alternatives INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, cover VARCHAR(255) DEFAULT NULL, advantage VARCHAR(255) DEFAULT NULL, incovenient VARCHAR(255) DEFAULT NULL, INDEX fk_products (id_products), INDEX fk_alternatives (id_alternatives), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB");
    }
    
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE alternatives');
        $this->addSql('DROP TABLE lists_products');
        $this->addSql('DROP TABLE lists');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE badge');
    }
    
}
