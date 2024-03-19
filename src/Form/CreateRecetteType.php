<?php

namespace App\Form;

use App\Entity\CategorieRecette;
use App\Entity\Recette;
use App\Entity\SousCategorieRecette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class CreateRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRecette', TextType::class)
            ->add('descRecette', TextareaType::class)
            ->add('TpsPrepa', TextType::class, [
                'mapped' => false,
                'label' => 'Temps de préparation au format 00:00',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^([01][0-9]|2[0-3]):[0-5][0-9]$/',
                        'message' => 'Veuillez saisir un temps de préparation valide au format 00:00.',
                    ]),
                ],
            ])

            ->add('TpsCuisson', TextType::class, [
                'mapped' => false,
                'label' => 'Temps de cuisson au format 00:00',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^([01][0-9]|2[0-3]):[0-5][0-9]$/',
                        'message' => 'Veuillez saisir un temps de cuisson valide au format 00:00.',
                    ]),
                ],
            ])

            ->add('TpsRepos', TextType::class, [
                'mapped' => false,
                'label' => 'Temps de repos au format 00:00',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^([01][0-9]|2[0-3]):[0-5][0-9]$/',
                        'message' => 'Veuillez saisir un temps de repos valide au format 00:00.',
                    ]),
                ],
            ])
            ->add('affiche', FileType::class)
            ->add('nbPers', IntegerType::class)
            ->add('difficulte', IntegerType::class)
            ->add('sousCategorieRecette', ChoiceType::class, [
                'placeholder' => 'Choisir une categorie de recette',
            ])
            ->add('ustensiles', CollectionType::class, [
                'entry_type' => UstensilesType::class,
                'label' => 'ustensiles',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('sections', CollectionType::class, [
                'entry_type' => SectionsType::class,
                'label' => 'Sections',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('categorieRecette', EntityType::class, [
                'mapped' => false,
                'class' => CategorieRecette::class,
                'choice_label' => 'libCatRecette',
                'placeholder' => 'Categories recettes',
                'label' => 'Choisir une categorie de recette',
            ])
            ->add('contenirs', CollectionType::class, [
                'entry_type' => NewStockType::class,
                'label' => 'ingredient',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('etapes', CollectionType::class, [
                'entry_type' => EtapesType::class,
                'label' => 'etapes',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('imageRecettes', CollectionType::class, [
                'entry_type' => ImageRecettesType::class,
                'label' => 'images de la recettes',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
//            ->add('sousFamilleIngredient', ChoiceType::class, [
//                'mapped' => false,
//                'placeholder' => 'Sous Famille d`ingredient (choisir une famille)',
//            ])
//            ->add('ingredients', EntityType::class, [
//                'mapped' => false,
//                'class' => Ingredient::class,
//                'choice_label' => 'nomIng',
//                'multiple' => true,
//                'expanded' => true,
//            ])
            ->add('submit', SubmitType::class)
        ;

        $formModifier = function (FormInterface $form, CategorieRecette $categorieRecette = null) {
            $sousCategoriesRecettes = null === $categorieRecette ? [] : $categorieRecette->getSousCategorieRecettes();
            $form->add('sousCategorieRecette', EntityType::class, [
                'class' => SousCategorieRecette::class,
                'choices' => $sousCategoriesRecettes,
                'choice_label' => 'libSousCategorieRecette',
                'placeholder' => 'Sous categorie de recettes',
                'label' => 'Choisir une Sous Categorie de recettes',
                'required' => true,
            ]);
        };

        $builder->get('categorieRecette')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $categorieRecette = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $categorieRecette);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
