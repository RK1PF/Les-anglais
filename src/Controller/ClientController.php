<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Email;
use App\Form\ClientInscriptionType;
use App\Form\EmailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function clientInscription(?Client $client, Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();

        $clientForm = $this->createForm(ClientInscriptionType::class, $client);

        $clientForm->handleRequest($request);
        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            // dd($clientForm->getData());
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
