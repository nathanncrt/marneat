<?php

namespace App\Controller\Admin;

use App\Entity\SousFamilleIngredient;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SousFamilleIngredientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousFamilleIngredient::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libSousFamImg', "Nom de la sous catégorie d'ingrédients"),
            AssociationField::new('familleIngredient', 'Catégorie parent')
                ->setFormTypeOptions([
                    'choice_label' => 'libFamIng',
                    'required' => true,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('familleIngredient')
                            ->orderBy('familleIngredient.libFamIng', 'ASC');
                    },
                ]),
            AssociationField::new('ingredients', "Nombre d'ingrédient(s) associée(s)")
                ->setFormTypeOptions([
                    'choice_label' => 'nomIng',
                    'required' => true,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('ingredients')
                            ->orderBy('ingredients.nomIng', 'ASC');
                    },
                ]),
        ];
    }

}
