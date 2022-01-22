<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'question')]
    public function index(): Response
    {
        return $this->render('question/index.html.twig', [
            'controller_name' => 'QuestionController',
        ]);
    }

    #[Route(path: '/api/comment-vote/{direction<up|down>}/{commentId}', name: 'api-vote-comment', methods:'POST')]
    public function commentVote($commentId, $direction)
    {
        if($direction === "up"){
            $voteCount = rand(1,987);
        } else {
            $voteCount = rand(0,7);
        }
        return $this->json([
            'commentID' => $commentId,
            'votes' => $voteCount,
            'directionVote' => $direction
        ]);
    }
}
