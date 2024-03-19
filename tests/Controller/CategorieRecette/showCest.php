<?php

namespace App\Tests\Controller\CategorieRecette;

use App\Factory\CategorieRecetteFactory;
use App\Factory\SousCategorieRecetteFactory;
use App\Tests\Support\ControllerTester;

class showCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /**  Teste si l'affichage d'une page de catégorie de recettes est correct.
     *
     */
    public function recipeCategoryResIsConform(ControllerTester $I): void
    {
        $recipeCategory = CategorieRecetteFactory::createOne();
        $I->amOnPage('/categorieRecette/'.$recipeCategory->getId());
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : {$recipeCategory->getLibCatRecette()}");
    }

    /** Teste si la création de 4 sous-catégories pour une catégorie de recettes
     * donne le résultat d'affichage attendu.
     */
    public function recipeCategoryAsSubCategory(ControllerTester $I): void
    {
        $recipeCategory = CategorieRecetteFactory::createOne();
        $recipeSubCategories = SousCategorieRecetteFactory::createMany(4, [
            'categorieRecette' => $recipeCategory,
        ]);
        $I->amOnPage('/categorieRecette/'.$recipeCategory->getId());
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : {$recipeCategory->getLibCatRecette()}");
        $I->seeNumberOfElements('div.recipeCategory__subCategories  > ul > li', 4);
    }
}
