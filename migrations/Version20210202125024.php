<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202125024 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE echange (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, expert_id INT DEFAULT NULL, INDEX IDX_B577E3BFA76ED395 (user_id), INDEX IDX_B577E3BFC5568CE4 (expert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFC5568CE4 FOREIGN KEY (expert_id) REFERENCES expert (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE echange');
    }
}
