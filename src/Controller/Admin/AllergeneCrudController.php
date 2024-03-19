<?php

namespace App\Controller\Admin;

use App\Entity\Allergene;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AllergeneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergene::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libAll', "Nom de l'allergène"),
            TextEditorField::new('descAll', "Description de l'allergène")->hideOnIndex(),
            AssociationField::new('ingredients', "Nombre ingrédients possédant l'allergène"),
            AssociationField::new('ingredients', "Liste des ingrédients possédant l'allergène")
                ->setFormTypeOptions([
                    'choice_label' => 'nomIng',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('ingredient')
                            ->orderBy('ingredient.nomIng', 'ASC');
                    },
                ])->hideOnIndex(),
        ];
    }
}
