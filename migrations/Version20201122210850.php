<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201122210850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipy ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipy ADD CONSTRAINT FK_CE89ED78B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CE89ED78B03A8386 ON recipy (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipy DROP FOREIGN KEY FK_CE89ED78B03A8386');
        $this->addSql('DROP INDEX IDX_CE89ED78B03A8386 ON recipy');
        $this->addSql('ALTER TABLE recipy DROP created_by_id');
    }
}
