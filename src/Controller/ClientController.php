<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientInscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'Pouet',
            'num' => 123,
        ]);
    }

    #[Route('/client/inscription', name: 'client-inscription')]
    public function clientInscription(?Client $client, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $client = new Client();

        $clientForm = $this->createForm(ClientInscriptionType::class, $client);

        $clientForm->handleRequest($request);
        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            // Hash du password
            $client->setPassword(
                $passwordHasher->hashPassword(
                    $client,
                    $clientForm->get('plainPassword')->getData()
                )
            )
                ->setRoles(['ROLE_CLIENT']);
            // Envoi dans la base de donnée
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('client');
        }

        return $this->render('client/connexions/inscription.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client,
            'clientForm' => $clientForm->createView(),
        ]);
    }
}
