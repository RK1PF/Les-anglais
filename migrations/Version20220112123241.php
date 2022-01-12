<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112123241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nom_contact VARCHAR(255) NOT NULL, prenom_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (categorie_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_76264285BCF5E72D (categorie_id), INDEX IDX_76264285F347EFB (produit_id), PRIMARY KEY(categorie_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commerce (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siren VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, banniere VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, association_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E7927C7419EB6921 (client_id), UNIQUE INDEX UNIQ_E7927C74EFB9C8A5 (association_id), UNIQUE INDEX UNIQ_E7927C74858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, lien VARCHAR(255) NOT NULL, date_ajout DATETIME NOT NULL, INDEX IDX_1C45FBAAF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prix_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, date_application DATETIME NOT NULL, INDEX IDX_A79730EDF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, stock INT NOT NULL, description VARCHAR(255) DEFAULT NULL, date_ajout DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_commande (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_47F5946EF347EFB (produit_id), INDEX IDX_47F5946E82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, date_ajout DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_produit (tags_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_F1907368D7B4FB4 (tags_id), INDEX IDX_F190736F347EFB (produit_id), PRIMARY KEY(tags_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tel (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, association_id INT DEFAULT NULL, vendeur_id INT DEFAULT NULL, num BIGINT NOT NULL, UNIQUE INDEX UNIQ_F037AB0F19EB6921 (client_id), UNIQUE INDEX UNIQ_F037AB0FEFB9C8A5 (association_id), UNIQUE INDEX UNIQ_F037AB0F858C065E (vendeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendeur (id INT AUTO_INCREMENT NOT NULL, commerce_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, UNIQUE INDEX UNIQ_7AF49996B09114B7 (commerce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C7419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE photo_produit ADD CONSTRAINT FK_1C45FBAAF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE prix_produit ADD CONSTRAINT FK_A79730EDF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit_commande ADD CONSTRAINT FK_47F5946E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE tags_produit ADD CONSTRAINT FK_F1907368D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_produit ADD CONSTRAINT FK_F190736F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0FEFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id)');
        $this->addSql('ALTER TABLE tel ADD CONSTRAINT FK_F037AB0F858C065E FOREIGN KEY (vendeur_id) REFERENCES vendeur (id)');
        $this->addSql('ALTER TABLE vendeur ADD CONSTRAINT FK_7AF49996B09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74EFB9C8A5');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0FEFB9C8A5');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285BCF5E72D');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C7419EB6921');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F19EB6921');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946E82EA2E54');
        $this->addSql('ALTER TABLE vendeur DROP FOREIGN KEY FK_7AF49996B09114B7');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285F347EFB');
        $this->addSql('ALTER TABLE photo_produit DROP FOREIGN KEY FK_1C45FBAAF347EFB');
        $this->addSql('ALTER TABLE prix_produit DROP FOREIGN KEY FK_A79730EDF347EFB');
        $this->addSql('ALTER TABLE produit_commande DROP FOREIGN KEY FK_47F5946EF347EFB');
        $this->addSql('ALTER TABLE tags_produit DROP FOREIGN KEY FK_F190736F347EFB');
        $this->addSql('ALTER TABLE tags_produit DROP FOREIGN KEY FK_F1907368D7B4FB4');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74858C065E');
        $this->addSql('ALTER TABLE tel DROP FOREIGN KEY FK_F037AB0F858C065E');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commerce');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE photo_produit');
        $this->addSql('DROP TABLE prix_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_commande');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_produit');
        $this->addSql('DROP TABLE tel');
        $this->addSql('DROP TABLE vendeur');
    }
}
