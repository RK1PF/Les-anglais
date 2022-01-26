<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220126082656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prix_produit');
        $this->addSql('ALTER TABLE client ADD roles JSON NOT NULL, ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB09114B7');
        $this->addSql('DROP INDEX IDX_6EEAA67DB09114B7 ON commande');
        $this->addSql('ALTER TABLE commande ADD prix_total DOUBLE PRECISION DEFAULT NULL, ADD statut VARCHAR(255) NOT NULL, ADD date_retrait DATE DEFAULT NULL, DROP commerce_id');
        $this->addSql('ALTER TABLE produit ADD prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE produit_commande ADD prix DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_application DATETIME NOT NULL, INDEX IDX_A79730EDF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE prix_produit ADD CONSTRAINT FK_A79730EDF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE client DROP roles, DROP is_verified');
        $this->addSql('ALTER TABLE commande ADD commerce_id INT NOT NULL, DROP prix_total, DROP statut, DROP date_retrait');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB09114B7 ON commande (commerce_id)');
        $this->addSql('ALTER TABLE produit DROP prix');
        $this->addSql('ALTER TABLE produit_commande DROP prix');
    }
}
