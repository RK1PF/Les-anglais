<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Commerce;
use App\Entity\Vendeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            // Vendeur
            $vendeur = new Vendeur();
            $vendeur->setNom($faker->lastName)
                    ->setPrenom($faker->firstName)
                    ->setMotdepasse($faker->password())
                    ->setDateInscription($faker->dateTimeThisMonth);
            $manager->persist($vendeur);
            //Commerce
            $commerce = new Commerce();
            $commerce->setNom($faker->company)
                     ->setSiren($faker->randomNumber(9,true))
                     ->setAdresse($faker->address)
                     ->setVille($faker->city)
                     ->setLogo($faker->imageUrl($width = 480, $height = 480, "business"))
                     ->setDescription($faker->sentence(10))
                     ->setBanniere($faker->imageUrl($width = 720, $height = 480, "business"))
                     ->setCodePostal($faker->postcode)
                     ->setVendeur($vendeur);
            $manager->persist($commerce)
        }

        // $client = new Client();
        // for ($i=0; $i < 10; $i++) { 
            
        //     $client->setNom($faker->lastName())
        //     ->setPrenom($faker->firstName())
        //     ->setVille($faker->city())
        //     ->setAdresse($faker->address())
        //     ->setCodePostal($faker->postcode());
        // }
       
        $manager->flush();
    }
}
