<?php 
// src/Form/DataTransformer/EmailToString.php
namespace App\Form\DataTransformer;

use App\Entity\Email;
use App\Entity\Vendeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmailToStringVendeur implements DataTransformerInterface
{
    private $entityManager;
    private $vendeur;

    public function __construct(EntityManagerInterface $entityManager, Vendeur $vendeur)
    {
        $this->entityManager = $entityManager;
        $this->vendeur = $vendeur;
    }

    /**
     * Transforms an object (email) to a string.
     *
     * @param  Email $email
     */
    public function transform($email): string
    {
        if (null === $email) {
            return '';
        }

        return $email->getEmail();
    }

    /**
     * Transforms a string to an object (email).
     *
     * @param  string $emailString
     * @throws TransformationFailedException if object (email) is not found.
     */
    public function reverseTransform($emailString): ?Email
    {
        // no email? Error!!!
        if (!$emailString) {
            throw new TransformationFailedException(sprintf(
                'The email is required'
            ));
        }
        
        $email = $this->entityManager
        ->getRepository(Email::class)
        // query for the email in database with this email
        ->findOneBy(['email' => $emailString])
        ;
        if ($email) {
            // Si l'email existe déjà dans notre base de données
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'The email "%s" does not exist!',
                $emailString
            ));
        } else {
            $email = new Email();
            $email->setEmail($emailString)->setVendeur($this->vendeur);
            // $this->vendeur->setEmail($email);
            /*TODO: Création d'un nouvel email dans la base de données*/
        }

        return $email;
    }
}