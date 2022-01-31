<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126145450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD prix_total DOUBLE PRECISION DEFAULT NULL, ADD statut VARCHAR(255) NOT NULL, ADD date_retrait DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit_commande ADD prix DOUBLE PRECISION NOT NULL, ADD quantite INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP password');
        $this->addSql('ALTER TABLE commande DROP prix_total, DROP statut, DROP date_retrait');
        $this->addSql('ALTER TABLE produit DROP prix');
        $this->addSql('ALTER TABLE produit_commande DROP prix, DROP quantite');
    }
}
