<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface ;


use App\Repository\ProduitRepository;
use App\Entity\Produit;
use App\Form\ProduitType;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'produit')]
    public function index(ProduitRepository $repository): Response
    {
        $repository = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repository->findAll();
        return $this->render('produit/index.html.twig', [
                'produit' => $produit,
            ]);
    }

    #[Route('/afficherproduit/{id}', name: 'afficheproduit')]

    public function afficherUnProduit(ProduitRepository $pr,$id) : Response {
        $produit = $pr->find($id);
        return $this->render('produit/afficherUnProduit.html.twig', ["produit"=>$produit]);
    }
/*
    #[Route("/modifproduit/{id}", name="modifproduit")]
    #[Route("/creationproduit", name="creationproduit")]

    public function modifierProduit(Produit $produit=null, Request $request, EntityManagerInterface $em) {
        if (!$produit){
            $produit=new Produit();
        }
        $form=$this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produit');
        }
        return $this->render('produit/modifProduit.html.twig', [
            "produit"=>$produit,
            "form"=>$form->createView()
        ]);
    } */
}