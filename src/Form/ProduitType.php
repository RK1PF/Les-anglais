<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Tags;
use App\Entity\PhotoProduit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
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
            // ->add('date_ajout')
            ->add('prix')
            ->add('categories', EntityType::class, [
                'choice_attr' => ChoiceList::attr($this, function (?Categorie $categorie) {
                    return $categorie ? [$categorie->getNom() => $categorie->getId()] : [];
                }),
                'mapped' => false,
                // 'multiple' => true,
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'label' => 'Choississez une catégorie',
                'required' => false
            ])    
            ->add('tags', EntityType::class, [
                'mapped' => false,
                'multiple' => true,
                'class' => Tags::class,
                'choice_label' => 'libelle',
                'label' => 'tags',
                'required' => false
            ])
            ->add('photoProduit', EntityType::class, [
                'mapped' => false,
                'multiple' => true,
                'class' => PhotoProduit::class,
                'choice_label' => 'lien',
                'label' => 'Choose photo',
                'required' => false
                // 'choice_label'=>'produit_id',
                // 'choice_label'=>'date_ajout'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
