<?php 
// src/Form/DataTransformer/NumberToPhone.php
namespace App\Form\DataTransformer;

use App\Entity\Tel;
use App\Entity\Vendeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NumberToPhoneVendeur implements DataTransformerInterface
{
    private $entityManager;
    private $vendeur;

    public function __construct(EntityManagerInterface $entityManager, Vendeur $vendeur)
    {
        $this->entityManager = $entityManager;
        $this->vendeur = $vendeur;
    }

    /**
     * Transforms an object (tel) to a int.
     *
     * @param  Tel $tel
     */
    public function transform($tel): ?int
    {
        if (null === $tel) {
            return null;
        }

        return $tel->getNum();
    }

    /**
     * Transforms a int to an object (tel).
     *
     * @param  int $telInt
     * @throws TransformationFailedException if object (tel) is not found.
     */
    public function reverseTransform($telInt): ?Tel
    {
        // no tel? Error!!!
        if (!$telInt) {
            throw new TransformationFailedException(sprintf(
                'The tel is required'
            ));
        }
        
        $tel = $this->entityManager
        ->getRepository(Tel::class)
        // query for the tel in database with this tel
        ->findOneBy(['num' => $telInt])
        ;
        if ($tel) {
            // Si le tel existe déjà dans notre base de données
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'The phone "%s" does not exist!',
                $telInt
            ));
        } else {
            $tel = new Tel();
            $tel->setNum($telInt)->setVendeur($this->vendeur);
        }

        return $tel;
    }
}