<?php

namespace App\Tests\Controller\SousCategorie;

use App\Factory\CategorieRecetteFactory;
use App\Factory\FamilleIngredientFactory;
use App\Factory\SousCategorieRecetteFactory;
use App\Tests\Support\ControllerTester;

class indexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si on peut acceder à la ressource ('/sousCategorieRecette/id').
     *
     */
    public function canAccessToSubCategoryPage(ControllerTester $I): void
    {
        $recipeCategory = CategorieRecetteFactory::createOne();

        $subFamily = SousCategorieRecetteFactory::createOne([
            'categorieRecette' => $recipeCategory,
        ]);

        $I->amOnPage('/sousCategorieRecette/'.$subFamily->getId());
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : {$subFamily->getLibSousCategorieRecette()}");
    }
}
