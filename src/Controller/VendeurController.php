<?php

namespace App\Controller;

use App\Entity\Vendeur;
use App\Form\VendeurType;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendeurController extends AbstractController
{
    #[Route('/vendeur', name: 'vendeur')]
    public function index(): Response
    {
        return $this->render('vendeur/index.html.twig', [
            'controller_name' => 'VendeurController',
        ]);
    }

    #[Route('/vendeurInscription', name: 'vendeur-inscription')]
    public function inscription(?Vendeur $vendeur, Request $request, EntityManagerInterface $em): Response
    {
        if(!$vendeur)
        {
        $vendeur = new Vendeur();
        }

        $form = $this->createForm(VendeurType::class, $vendeur);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         $vendeur->setDateInscription(new \DateTime());
         $em->persist($vendeur);
         $em->flush();
         return $this->redirectToRoute('vendeur');
        }

        return $this->render('vendeur/modifVendeur.html.twig',
        [
            'vendeur' => $vendeur,
            'form'=> $form->createView()
        ]);
    }

}
