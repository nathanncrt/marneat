<?php

namespace App\Tests\Controller\Ingredient;

use App\Factory\FamilleIngredientFactory;
use App\Factory\IngredientFactory;
use App\Factory\SousFamilleIngredientFactory;
use App\Factory\UniteMesureFactory;
use App\Tests\Support\ControllerTester;

class indexCest
{
    // tests
    /** Teste si le résultat d'une requête sur le catalogue d'ingrédients est correct.
     *
     */

    public function ingredientPageResult(ControllerTester $I): void
    {
        $I->amOnPage('/ingredients');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Notre catalogue d'ingrédients");
    }

    /** Teste si le contenu d'une carte d'un ingrédient est correct.
     *
     */
    public function ingredientCardResConforme(ControllerTester $I): void
    {
        $familleIngredient = FamilleIngredientFactory::createOne();

        $subFamily = SousFamilleIngredientFactory::createOne([
            'familleIngredient' => $familleIngredient,
        ]);

        $ingredient = IngredientFactory::createOne([
            'uniteMesure' => UniteMesureFactory::createOne(),
            'sousFamilleIngredient' => $subFamily,
            'nomIng' => 'Abadèche',
        ]);

        $I->amOnPage('/ingredients');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Notre catalogue d'ingrédients");
        $I->seeElement('.ingredient__list .ingredient__card');
        $I->seeElement('.ingredient__card a[href="/ingredient/'.$ingredient->getId().'"]');
        $I->seeElement('.ingredient__info-title:contains("Abadèche")');
    }

}

