<?php

namespace App\Controller;

use App\Entity\Association;
use App\Repository\AssociationRepository;
use App\Form\AssociationType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/association")]

class AssociationController extends AbstractController
{
     #[Route("/", name: "association")]

    public function index(AssociationRepository $repository): Response
    {
        $associations = $repository->findAll();
        return $this->render('association/index.html.twig', [
            'associations' => $associations
        ]);
    }

    #[Route("/afficheassociation/{id}", name: "afficheassociation")]
    public function afficherUneAssociation(Association $association): Response
    {
        return $this->render('association/afficheUneSeule.html.twig', ['association' => $association]);
    }

    #[Route("/creationassociation", name: "creationassociation")]

    public function modifAssociation(?Association $association, Request $request, EntityManagerInterface $em)
    {
        if(!$association)
        {
        $association = new Association();
        }

        $form = $this->createForm(AssociationType::class, $association);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
         $em->persist($association);
         $em->flush();
         return $this->redirectToRoute('association');
        }

        return $this->render('association/modifAssociation.html.twig',
        [
            'association' => $association,
            'form'=> $form->createView()
        ]);
    }
















}
