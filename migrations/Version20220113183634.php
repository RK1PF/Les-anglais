<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220113183634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD commerce_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB09114B7 ON commande (commerce_id)');
        $this->addSql('ALTER TABLE produit_commande ADD quantite INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB09114B7');
        $this->addSql('DROP INDEX IDX_6EEAA67DB09114B7 ON commande');
        $this->addSql('ALTER TABLE commande DROP commerce_id');
        $this->addSql('ALTER TABLE produit_commande DROP quantite');
    }
}
