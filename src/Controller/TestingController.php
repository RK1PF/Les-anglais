<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\TestingSubmit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestingController extends AbstractController
{
    // Ce contrôleur sert au test
    #[Route(path:'/', name: 'homepage')]
    public function home()
    {
        return $this->render('testing/homepage.html.twig');
    }
    #[Route('/testing', name: 'testing')]
    public function index(): Response
    {
        return $this->render('testing/index.html.twig', [
            'controller_name' => 'TestingController',
        ]);
    }

    #[Route(path: '/testing/response', name: 'response-testing')]
    public function testingResponse()
    {
        return new Response("<h1>Res Testing Page</h1>");
    }

    #[Route(path: '/testing/json', name: 'json-testing')]
    public function testingJson()
    {
        return $this->json([
            "premier" => 1,
            "second" => true,
            "String" => "Ce string là",
            "Res" => "Res Testing Page",
            "Json" => ["test" => 1-1]
        ],200,[
            "premier" => 1000,
            "second" => true,
            "String" => "Ce string là"
        ]);
    }
    #[Route(path: '/question/{slug}', name: 'question-show', methods: ['GET'])]
    public function show($slug)
    {
        $question = ucfirst(str_replace('-', ' ', $slug)) . "?";
        $answers = [
            "Peut-être avec la bouche mais sans les dents",
            "Sans la bouche mais avec les dents",
            "Par la pensée...🧠"
        ];
        dump($question, $answers);
        return $this->render('testing/show.html.twig', [
            'question' => $question,
            'answers' => $answers
        ]);
    }

    #[Route(path:'/test/submit', name: 'test-submit')]
    public function testSubmit(?Client $client, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {$client = new Client();

        $clientForm = $this->createForm(TestingSubmit::class, $client);

        $clientForm->handleRequest($request);
        if ($clientForm->isSubmitted() && $clientForm->isValid()) {
            // Hash du password
            $client->setPassword(
                $passwordHasher->hashPassword(
                    $client,
                    $clientForm->get('plainPassword')->getData()
                )
            )
                ->setRoles(['ROLE_CLIENT']);
            // Envoi dans la base de donnée
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('client');
        }
        return $this->render('testing/submit.html.twig', [
            'controller_name' => 'TestingController',
            'client' => $client,
            'testingForm' => $clientForm->createView(),
        ]);
    }
}
