<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CommandeRepository;
use App\Repository\ProduitCommandeRepository;
use App\Repository\ProduitRepository;


class CommandeController extends AbstractController
{
    #[Route('/commande/{id}', name: 'commande')]
    public function commande(CommandeRepository $cr, ProduitCommandeRepository $pcr,ProduitRepository $pr,$id) : Response {
        $commande = $cr->find($id);
        $produitCommande = $pcr->find($id);
        $produit = $pr->find($id);
        return $this->render('commande/factures.html.twig', [
            "commande"=>$commande,
            "produitcommande"=>$produitCommande,
            "produit"=>$produit
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
