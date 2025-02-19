<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206101400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD COLUMN IF NOT EXISTS icon VARCHAR(255) NOT NULL, ADD COLUMN IF NOT EXISTS cover LONGTEXT  NOT NULL, ADD COLUMN IF NOT EXISTS description LONGTEXT NOT NULL, ADD COLUMN IF NOT EXISTS website LONGTEXT NOT NULL, ADD COLUMN IF NOT EXISTS github LONGTEXT NOT NULL');        
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT NOT NULL, CHANGE first_name first_name VARCHAR(50) NOT NULL, CHANGE last_name last_name VARCHAR(255), CHANGE username username VARCHAR(50) NOT NULL, CHANGE is_admin is_admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP icon, DROP cover, DROP description, DROP website, DROP github');
        $this->addSql('ALTER TABLE users CHANGE id_users id_users INT DEFAULT NULL, CHANGE first_name first_name VARCHAR(50) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255), CHANGE username username VARCHAR(50) DEFAULT NULL, CHANGE is_admin is_admin TINYINT(1) DEFAULT NULL');
    }
}
