<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\PhotoProduit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('stock')
            ->add('description',   TextareaType::class)
            ->add('date_ajout')
            ->add('prix')
            ->add('categories')
            ->add('tags')
            ->add('photoProduit', EntityType::class, [
                'mapped'=>false,
                'multiple'=>true,
                'class'=>PhotoProduit::class,
                'choice_label'=>'lien',
                'label'=>'Choose photo'
                // 'choice_label'=>'produit_id',
                // 'choice_label'=>'date_ajout'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
