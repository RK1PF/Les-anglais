<?php 
// src/Form/DataTransformer/StringToTags.php
namespace App\Form\DataTransformer;

use App\Entity\Tags;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToTags implements DataTransformerInterface
{
    private $entityManager;
    private $produit;

    public function __construct(EntityManagerInterface $entityManager, Produit $produit)
    {
        $this->entityManager = $entityManager;
        $this->produit = $produit;
    }

    /**
     * Transforms an object (tags) to a string.
     *
     * @param  Tags $tags
     */
    public function transform($tags): ?string
    {
        if (null === $tags) {
            return null;
        }

        return $tags->getLibelle();
    }

    /**
     * Transforms a string to an object (tags).
     *
     * @param  string $tagsString
     * @throws TransformationFailedException if object (tags) is not found.
     */
    public function reverseTransform($tagsString): ?Tags
    {
        // no tags? Error!!!
        if (!$tagsString) {
            throw new TransformationFailedException(sprintf(
                'The tags is required'
            ));
        }
        
        $tags = $this->entityManager
        ->getRepository(Tags::class)
        // query for the tags in database with this tags
        ->findOneBy(['string' => $tagsString])
        ;
        if ($tags) {
            // Si le tags existe déjà dans notre base de données
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'The tags "%s" does not exist!',
                $tagsString
            ));
        } else {
            $tags = new Tags();
            $tags->setLibelle($tagsString)->addProduit($this->produit);
        }

        return $tags;
    }
}