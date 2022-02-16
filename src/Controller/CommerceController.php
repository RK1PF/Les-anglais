<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommerceController extends AbstractController
{
    #[Route('/commerce', name: 'commerce')]
    public function index(): Response
    {
        return $this->render('commerce/index.html.twig', [
            'controller_name' => 'CommerceController',
        ]);
    }
}
