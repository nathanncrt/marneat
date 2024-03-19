<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomRecette', 'Nom de la recette '),
            DateTimeField::new('datePubli', 'Date de publication (Date, Heure)'),
            AssociationField::new('userCreator', 'Créateur')
                ->setFormTypeOptions([
                    'choice_label' => 'username',
                    'required' => true,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('userCreator')
                            ->orderBy('userCreator.username', 'ASC');
                    },
                ]),
            TextEditorField::new('descRecette', 'Description de la recette')->hideOnIndex(),

            IntegerField::new('nbPers', 'Nombre de personne(s)')
                ->setFormTypeOptions([
                    'attr' => ['min' => 0],
                ])
                ->hideOnIndex(),

            IntegerField::new('difficulte', 'Niveau de difficulté de la recette (/5)')
                ->setFormTypeOptions([
                    'attr' => ['max' => 5, 'min' => 0],
                ])
                ->hideOnIndex(),
            TimeField::new('tpsPrepa', 'Temps de préparation')->hideOnIndex(),
            TimeField::new('tpsCuisson', 'Temps de cuisson')->hideOnIndex(),
            TimeField::new('tpsRepos', 'Temps de repos')->hideOnIndex(),

            AssociationField::new('ustensiles', 'Ustensiles')
                ->setFormTypeOptions([
                    'choice_label' => 'nomUs',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('ustensiles')
                            ->orderBy('ustensiles.nomUs', 'ASC');
                    },
                ])->hideOnIndex(),

            AssociationField::new('sections', 'Appartient à Section(s):')
                ->setFormTypeOptions([
                    'choice_label' => 'libSec',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('sections')
                            ->orderBy('sections.libSec', 'ASC');
                    },
                ])->hideOnIndex(),

            AssociationField::new('sousCategorieRecette', 'Appartient à la Sous catégorie:')
                ->setFormTypeOptions([
                    'choice_label' => 'libSousCategorieRecette',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('sousCategorieRecette')
                            ->orderBy('sousCategorieRecette.libSousCategorieRecette', 'ASC');
                    },
                ])->hideOnIndex(),
        ];
    }
}
