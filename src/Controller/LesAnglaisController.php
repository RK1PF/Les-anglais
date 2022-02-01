<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path:'/', name: 'homepage')]

class LesAnglaisController extends AbstractController
{
    #[Route(path:'/', name: 'index')]
    public function index(): Response
    {
        return $this->render('les_anglais/index.html.twig', [
            'controller_name' => 'LesAnglaisController',
        ]);
    }
}
