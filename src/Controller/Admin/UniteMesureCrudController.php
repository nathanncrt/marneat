<?php

namespace App\Controller\Admin;

use App\Entity\UniteMesure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UniteMesureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UniteMesure::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('libUm', "Nom de l'unité de mesure"),
            TextField::new('codeUm', "Code d'unité de mesure"),
        ];
    }
}
