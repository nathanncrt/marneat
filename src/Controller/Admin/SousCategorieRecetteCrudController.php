<?php

namespace App\Controller\Admin;

use App\Entity\SousCategorieRecette;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SousCategorieRecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousCategorieRecette::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libSousCategorieRecette', 'Nom de la sous catégorie de recette'),
            AssociationField::new('categorieRecette', 'Catégorie parent')
                ->setFormTypeOptions([
                    'choice_label' => 'libCatRecette',
                    'required' => true,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('categorieRecette')
                            ->orderBy('categorieRecette.libCatRecette', 'ASC');
                    },
                ]),
            AssociationField::new('recettes', 'Nombre de recette(s) associée(s)')
                ->setFormTypeOptions([
                    'choice_label' => 'nomRecette',
                    'required' => true,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('recettes')
                            ->orderBy('recettes.nomRecette', 'ASC');
                    },
                ]),
        ];
    }
}
