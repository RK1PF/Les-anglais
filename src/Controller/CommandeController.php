<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CommandeRepository;


class CommandeController extends AbstractController
{
    #[Route('/commande/{id}', name: 'commande')]
    public function commande(CommandeRepository $cr,$id) : Response {
        $commande = $cr->find($id);
        return $this->render('commande/factures.html.twig', [
            "commande"=>$commande
        ]);
    }

    #[Route('/factures', name: 'factures')]
    // public function index(): Response

    public function factures(): Response
    {
        return $this->render('commande/factures.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    #[Route('/gestion_commande', name: 'gestion_commande')]
    public function gestion_commande(): Response
    {
        return $this->render('commande/commande.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }
}
