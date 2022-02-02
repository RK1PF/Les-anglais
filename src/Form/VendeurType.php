<?php

namespace App\Form;

use App\Entity\Commerce;
use App\Entity\Vendeur;
use App\Form\DataTransformer\EmailToString;
use App\Form\DataTransformer\EmailToStringVendeur;
use App\Form\DataTransformer\NumberToPhone;
use App\Form\DataTransformer\NumberToPhoneVendeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VendeurType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('motdepasse')
           // ->add('date_inscription')
            ->add('commerce')
            ->add('commerce', EntityType::class, [
                'mapped' => false,  
                'multiple' => true,                 
                'class' => Commerce::class,                 
                'choice_label' => 'nom',                 
                'label' => 'commerce',                 
                'required' => false             
            ])
            ->add('tel', NumberType::class, [
                'invalid_message' => 'Pas bon ton tel brooo'
            ])
            ->add('email', EmailType::class, [
                'invalid_message' => 'Pas bon ton mail brooo'
            ])

            ->add('Enregistrer', SubmitType::class);
        ;

        $builder
            ->get('email')
            ->addModelTransformer(new EmailToStringVendeur($this->entityManager, $builder->getData()));
        $builder
            ->get('tel')
            ->addModelTransformer(new NumberToPhoneVendeur($this->entityManager, $builder->getData()));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendeur::class,
        ]);
    }
}
