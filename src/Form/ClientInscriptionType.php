<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use App\Form\DataTransformer\EmailToString;
use App\Form\DataTransformer\NumberToPhone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientInscriptionType extends AbstractType
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
            ->add('adresse')
            ->add('ville')
            ->add('code_postal')
            ->add('tel', NumberType::class, [
                'invalid_message' => 'Pas bon ton tel brooo'
            ])
            ->add('email', EmailType::class, [
                'invalid_message' => 'Pas bon ton mail brooo'
            ])
            ->add('password', PasswordType::class)
            ->add('Enregistrer', SubmitType::class);

        $builder
            ->get('email')
            ->addModelTransformer(new EmailToString($this->entityManager, $builder->getData()));
        $builder
            ->get('tel')
            ->addModelTransformer(new NumberToPhone($this->entityManager, $builder->getData()));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
