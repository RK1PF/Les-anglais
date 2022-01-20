<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserInscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/userInscription', name: 'userInscription')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        $user = new Users();
        $form = $this->createForm(UserInscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordCrypte = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($passwordCrypte);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("userInscription");
        }

        return $this->render('user/inscription.html.twig', [
            "form" => $form->createView()
        ]);
    }


    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $util)
    {
        return $this->render("user/login.html.twig", [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);
    }


    #[Route('/deconnexion', name: 'deconnexion')]
    public function deconnexion()
    {
    }
}
