<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientInscriptionType;
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
        
        $form = $this->createForm(ClientInscriptionType::class, $client);

        $form -> handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         $em->persist($client);
         $em->flush();
         return $this->redirectToRoute('client');
        }

        return $this->render('client/connexions/inscription.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }
}
