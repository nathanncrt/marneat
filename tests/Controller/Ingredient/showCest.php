<?php

namespace App\Tests\Controller\Ingredient;

use App\Factory\FamilleIngredientFactory;
use App\Factory\IngredientFactory;
use App\Factory\SousFamilleIngredientFactory;
use App\Factory\UniteMesureFactory;
use App\Tests\Support\ControllerTester;

class showCest
{
    // tests

    /** Teste le résultat de l'affiche d'une page d'ingrédient.
     *
     */
    public function ingredientPageResConforme(ControllerTester $I): void
    {
        $familleIngredient = FamilleIngredientFactory::createOne();

        $subFamily = SousFamilleIngredientFactory::createOne([
            'familleIngredient' => $familleIngredient,
        ]);

        $ingredient = IngredientFactory::createOne([
            'uniteMesure' => UniteMesureFactory::createOne(),
            'sousFamilleIngredient' => $subFamily,
            'nomIng' => 'Ingredient',
        ]);

        $I->amOnPage('/ingredient/'.$ingredient->getId());
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Page de l'ingrédient : {$ingredient->getNomIng()}");
    }
}
