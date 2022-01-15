<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestingController extends AbstractController
{
    #[Route('/testing', name: 'testing')]
    public function index(): Response
    {
        return $this->render('testing/index.html.twig', [
            'controller_name' => 'TestingController',
        ]);
    }
    #[Route(path:'/testing/res', name: 'res-testing')]
    public function res()
    {
        return new Response("Res Testing Page");   
    }
    #[Route(path:'/question/{slug}', name: 'question')]
    public function show($slug)
    {
        $answers = [
            "Peut-être avec la bouche mais sans les dents",
            "Sans la bouche mais avec les dents",
            "Par la pensée...🧠"
        ];
        return $this->render('testing/question.html.twig', [
            'question' => ucfirst(str_replace('-', ' ', $slug)),
            'answers' => $answers
        ]);
    }
}
