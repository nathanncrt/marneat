<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ingredient::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomIng', "Nom de l'ingrédient"),
            TextField::new('allergene', 'Allergène'),
            AssociationField::new('allergene', 'Allergène')
                ->setFormTypeOptions([
                    'choice_label' => 'libAll',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('allergene')
                            ->orderBy('allergene.libAll', 'ASC');
                    },
                    ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getAllergene() ? $entity->getAllergene() : '';
                })
                ->hideOnIndex(),
        ];
    }
}
