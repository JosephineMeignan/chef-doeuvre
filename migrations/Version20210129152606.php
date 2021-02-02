<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210129152606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE expert_theme');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expert_theme (expert_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_35A5E75059027487 (theme_id), INDEX IDX_35A5E750C5568CE4 (expert_id), PRIMARY KEY(expert_id, theme_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE expert_theme ADD CONSTRAINT FK_35A5E75059027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expert_theme ADD CONSTRAINT FK_35A5E750C5568CE4 FOREIGN KEY (expert_id) REFERENCES expert (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
