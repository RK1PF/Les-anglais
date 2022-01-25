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
    #[Route('/gestion_commande', name: 'gestion_commande')]
    public function index(CommandeRepository $cr, ProduitCommandeRepository $pcr, ProduitRepository $pr, $id): Response
    {
        $commande = $cr->find($id);
        $produitCommande = $pcr->find($id);
        $produit = $pr->find($id);
        return $this->render('commande/commande.html.twig', [
            "commande" => $commande,
            "produitcommande" => $produitCommande,
            "produit" => $produit
        ]);
    }

    #[Route('/commande/{id}', name: 'commande')]
    public function commande(CommandeRepository $cr, ProduitCommandeRepository $pcr, ProduitRepository $pr, $id): Response
    {
        $commande = $cr->find($id);
        $produitCommande = $pcr->find($id);
        $produit = $pr->find($id);
        return $this->render('commande/commande.html.twig', [
            "commande" => $commande,
            "produitcommande" => $produitCommande,
            "produit" => $produit
        ]);
    }

    #[Route('/factures', name: 'factures')]
    public function factures(CommandeRepository $cr, ProduitCommandeRepository $pcr, ProduitRepository $pr, $id): Response
    {
        $commande = $cr->find($id);
        $produitCommande = $pcr->find($id);
        $produit = $pr->find($id);
        return $this->render('commande/commande.html.twig', [
            "commande" => $commande,
            "produitcommande" => $produitCommande,
            "produit" => $produit
        ]);
    }

    #[Route('/paiement', name: 'paiement')]
    public function paiement(CommandeRepository $cr, $id): Response
    {
        $commande = $cr->find($id);
        return $this->render('commande/paiement.html.twig', [
            "commande" => $commande
        ]);
    }
}
