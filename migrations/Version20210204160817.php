<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204160817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B297A76ED395 ON profil (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649275ED078');
        $this->addSql('DROP INDEX UNIQ_8D93D649275ED078 ON user');
        $this->addSql('ALTER TABLE user DROP profil_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297A76ED395');
        $this->addSql('DROP INDEX UNIQ_E6D6B297A76ED395 ON profil');
        $this->addSql('ALTER TABLE profil DROP user_id');
        $this->addSql('ALTER TABLE user ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649275ED078 ON user (profil_id)');
    }
}
