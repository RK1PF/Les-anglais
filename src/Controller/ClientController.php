<?php

namespace App\Controller;

use App\Entity\Client;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Email;
use App\Form\ClientInscriptionType;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
    #[Route('/client', name: 'client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'Pouet',
            'num' => 123,
        ]);
    }

    #[Route('/client/inscription', name: 'client-inscription')]
    public function clientInscription(?Client $client, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $client = new Client();

        $clientForm = $this->createForm(ClientInscriptionType::class, $client);

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
            
            /*FIXME:Emailing debug*/
            $client->setId(987);
            $em->persist($client);

            // generate a signed url and email it to the client
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $client,
                (new TemplatedEmail())
                ->from(new Address('dev.raihau@gmail.com', 'rk1pf Mail Bot'))
                ->to($client->getEmail()->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // Temporarely here
            $em->flush();
            // do anything else you need here, like send an email
            return $this->redirectToRoute('client');
        }

        return $this->render('client/connexions/inscription.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client,
            'clientForm' => $clientForm->createView(),
        ]);
    }
    #[Route(path:'/sendmail', name: 'sendmail')]
    public function sendMail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('dev.raihau@gmail.com')
            ->to('dev.raihau@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
    }
}
