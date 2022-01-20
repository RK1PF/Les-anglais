<?php

namespace App\DataFixtures;

use App\Entity\Association;
use Faker\Factory;
use App\Entity\Tel;
use Faker\Generator;
use App\Entity\Email;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Vendeur;
use App\Entity\Commerce;
use App\Entity\Produit;
use App\Entity\ProduitCommande;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $this->vendeur($faker, $manager);

        $manager->flush();
    }
    public function vendeur(Generator $faker, ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            // Vendeur
            $vendeur = new Vendeur();
            $vendeur->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setMotdepasse($faker->password())
                ->setDateInscription($faker->dateTimeThisMonth);
            $manager->persist($vendeur);
            // commerce
            $this->commerce($faker, $manager, $vendeur);
            $this->tel($faker, $manager, null, null, $vendeur);
            $this->email($faker, $manager, null, null, $vendeur);
        }
    }
    public function commerce(
        Generator $faker,
        ObjectManager $manager,
        Vendeur $vendeur
    ): Commerce {
        //Commerce
        $commerce = new Commerce();
        $commerce->setNom($faker->company)
            ->setSiren($faker->randomNumber(9, true))
            ->setAdresse($faker->address)
            ->setVille($faker->city)
            ->setLogo($faker->imageUrl($width = 480, $height = 480, "business"))
            ->setDescription("Lorem ipsum dolor sit." . rand(1, 987))
            ->setBanniere($faker->imageUrl($width = 720, $height = 480, "business"))
            ->setCodePostal(intval($faker->postcode))
            ->setVendeur($vendeur);
        $manager->persist($commerce);
        // Ajout de clients au commerce
        for ($i = 0; $i < random_int(1, 9); $i++) {
            $client = $this->client($faker, $manager);
            // Ajout de Commandes au Client
            for ($i = 0; $i < random_int(1, 5); $i++) {
                $this->commande($faker, $manager, $client, $commerce);
            }
        }
        return $commerce;
    }
    public function tel(
        Generator $faker,
        ObjectManager $manager,
        Client $client = null,
        Association $association = null,
        Vendeur $vendeur = null
    ): Tel {
        if ($client) {
            $tel = new Tel();
            $tel->setNum($faker->randomNumber(9, true))
                ->setClient($client);
            $manager->persist($tel);
        }
        if ($association) {
            $tel = new Tel();
            $tel->setNum($faker->randomNumber(9, true))
                ->setAssociation($association);
            $manager->persist($tel);
        }
        if ($vendeur) {
            $tel = new Tel();
            $tel->setNum($faker->randomNumber(9, true))
                ->setVendeur($vendeur);
            $manager->persist($tel);
        }
        return $tel;
    }
    public function email(
        Generator $faker,
        ObjectManager $manager,
        Client $client = null,
        Association $association = null,
        Vendeur $vendeur = null
    ): Email {
        if ($client) {
            $email = new Email();
            $email->setEmail($faker->email)
                ->setClient($client);
            $manager->persist($email);
        }
        if ($association) {
            $email = new Email();
            $email->setEmail($faker->email)
                ->setAssociation($association);
            $manager->persist($email);
        }
        if ($vendeur) {
            $email = new Email();
            $email->setEmail($faker->email)
                ->setVendeur($vendeur);
            $manager->persist($email);
        }
        return $email;
    }
    public function client(
        Generator $faker,
        ObjectManager $manager,
    ): Client {
        // client
        $client = new Client();
        $client->setNom($faker->lastName())
            ->setPrenom($faker->firstName())
            ->setVille($faker->city())
            ->setAdresse($faker->address())
            ->setPassword($faker->password())
            ->setCodePostal(intval($faker->postcode()))
            ->setTel($this->tel($faker, $manager, $client))
            ->setEmail($this->email($faker, $manager, $client));

        $manager->persist($client);
        return $client;
    }
    public function commande(
        Generator $faker,
        ObjectManager $manager,
        Client $client,
        Commerce $commerce
    ): Commande {
        // commande
        $commande = new Commande();
        $commande->setClient($client)
            ->setDateCreation($faker->dateTimeThisMonth)
            ->setCommerce($commerce);

        $manager->persist($commande);
        /*TODO:produit*/

        return $commande;
    }
    public function produit(
        Generator $faker,
        ObjectManager $manager,
    ): Produit {
        $produit = new Produit();
        $produit->setNom($faker->randomElement(['Casque' . random_int(1, 987), 'Ecran' . random_int(1, 987), 'Stylo' . random_int(1, 987), 'Chaise' . random_int(1, 987)]))
            ->setStock(random_int(4, 987))
            ->setDescription($faker->sentence(10))
            ->setDateAjout($faker->dateTimeThisMonth);
        $manager->persist($produit);

        return $produit;
    }
    public function produitCommande(
        ObjectManager $manager,
        Produit $produit,
        Commande $commande
    ): ProduitCommande {
        $produitCommande = new ProduitCommande();
        $produitCommande->setProduit($produit)
            ->setCommande($commande)
            ->setQuantite(random_int(1, 5));
        $manager->persist($produitCommande);
        return $produitCommande;
    }
}
