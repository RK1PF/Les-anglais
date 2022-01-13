<?php

namespace App\Form;

use App\Entity\Commerce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommerceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('siren')
            ->add('adresse')
            ->add('ville')
            ->add('logo')
            ->add('description')
            ->add('banniere')
            ->add('code_postal')
            ->add('vendeur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commerce::class,
        ]);
    }
}
