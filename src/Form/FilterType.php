<?php

namespace App\Form;

use App\Entity\Allergene;
use App\Entity\CategorieRecette;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\SousCategorieRecette;
use App\Factory\AllergeneFactory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorieRecette', EntityType::class, [
                'mapped' => false,
                'class' => CategorieRecette::class,
                'choice_label' => 'libCatRecette',
                'placeholder' => 'Toutes les catégories',
                'required' => false,
                'data' => null,
            ])
            ->add('sousCategorieRecette', EntityType::class, [
                'class' => SousCategorieRecette::class,
                'choice_label' => 'libSousCategorieRecette',
                'placeholder' => 'Toutes les sous-catégories',
                'required' => false,
                'data' => null,
            ])
            ->add('ingredients', EntityType::class, [
                'mapped' => false,
                'class' => Ingredient::class,
                'choice_label' => 'nomIng',
                'placeholder' => 'Tous les ingrédients',
                'required' => false,
                'data' => null,
            ])
            ->add('allergenes', EntityType::class, [
                'mapped' => false,
                'class' => Allergene::class,
                'choice_label' => 'libAll',
                'placeholder' => 'Tous les allergènes',
                'required' => false,
                'data' => null,
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
