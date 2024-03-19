<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Section::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libSec', 'Nom de la section'),
            AssociationField::new('recettes', 'Les recettes')
                ->setFormTypeOptions([
                    'choice_label' => 'nomRecette',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('recettes')
                            ->orderBy('recettes.nomRecette', 'ASC');
                    },
                ])->hideOnIndex(),
            AssociationField::new('recettes', 'Nombre de recette(s)')
                ->setFormTypeOptions([
                    'choice_label' => 'nomRecette',
                    'required' => false,
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('recettes')
                            ->orderBy('recettes.nomRecette', 'ASC');
                    },
                ])->hideOnDetail(),
        ];
    }

}
