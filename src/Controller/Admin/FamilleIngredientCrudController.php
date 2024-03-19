<?php

namespace App\Controller\Admin;

use App\Entity\FamilleIngredient;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FamilleIngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FamilleIngredient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libFamIng', "Nom de la famille d'ingrédient"),
            AssociationField::new('sousFamilleIngredients', "Sous famille d'ingrédient")
                ->setFormTypeOptions([
                    'choice_label' => 'libSousFamImg',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('sousFamilleIngredients')
                            ->orderBy('sousFamilleIngredients.libSousFamImg', 'ASC');
                    },
                ]),
        ];
    }
}
