<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    #[Route('/modifier_commerce', name: 'modifier_commerce')]
    public function modifier_commerce(): Response
    {
        return $this->render('vendeur/modifier_commerce.html.twig', [
            'controller_name' => 'VendeurController',
        ]);
    }
}
