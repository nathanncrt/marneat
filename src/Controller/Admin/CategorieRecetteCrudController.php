<?php

namespace App\Controller\Admin;

use App\Entity\CategorieRecette;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieRecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieRecette::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libCatRecette', 'Nom de la catégorie'),
            AssociationField::new('sousCategorieRecettes', 'Sous catégorie associée(s)')
                ->setFormTypeOptions([
                    'choice_label' => 'libSousCategorieRecette',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('sousCategorieRecettes')
                            ->orderBy('sousCategorieRecettes.libSousCategorieRecette', 'ASC');
                    },
                ]),
        ];
    }
}
