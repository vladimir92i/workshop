<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240924111412 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, control_id_id INT DEFAULT NULL, creator_id_id INT NOT NULL, room_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, validation TINYINT(1) DEFAULT NULL, max_capacity INT DEFAULT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5387574AC4BD370A (control_id_id), INDEX IDX_5387574AF05788E9 (creator_id_id), INDEX IDX_5387574A35F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, event_id_id INT NOT NULL, INDEX IDX_4DA2399D86650F (user_id_id), INDEX IDX_4DA2393E5F2F7B (event_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, floor VARCHAR(15) NOT NULL, capacity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, class VARCHAR(90) DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AC4BD370A FOREIGN KEY (control_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574AF05788E9 FOREIGN KEY (creator_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A35F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2399D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA2393E5F2F7B FOREIGN KEY (event_id_id) REFERENCES events (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AC4BD370A');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574AF05788E9');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A35F83FFC');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2399D86650F');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA2393E5F2F7B');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE users');
    }
}
