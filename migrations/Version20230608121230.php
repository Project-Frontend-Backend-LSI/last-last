<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608121230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD28545BDF5');
        $this->addSql('DROP INDEX IDX_E19D9AD28545BDF5 ON service');
        $this->addSql('ALTER TABLE service ADD idfreelancer VARCHAR(255) NOT NULL, DROP freelancer_id, CHANGE title title VARCHAR(255) NOT NULL, CHANGE subtitle subtitle VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD freelancer_id INT NOT NULL, DROP idfreelancer, CHANGE title title VARCHAR(300) NOT NULL, CHANGE subtitle subtitle LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD28545BDF5 FOREIGN KEY (freelancer_id) REFERENCES freelancer (id)');
        $this->addSql('CREATE INDEX IDX_E19D9AD28545BDF5 ON service (freelancer_id)');
    }
}
