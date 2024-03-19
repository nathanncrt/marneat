<?php

namespace App\Tests\Controller\Profil;

use App\Factory\FamilleIngredientFactory;
use App\Factory\IngredientFactory;
use App\Factory\SousFamilleIngredientFactory;
use App\Factory\StockFactory;
use App\Factory\UniteMesureFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class stockDeleteCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si un utilisateur peut accéder à la page de suppression d'un ingrédient de son stock.
     *
     */
    public function userCanDeleteAStock(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.bart',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Bart',
        ]);

        $familleIngredient = FamilleIngredientFactory::createOne();

        $subFamily = SousFamilleIngredientFactory::createOne([
            'familleIngredient' => $familleIngredient,
        ]);

        $ingredient = IngredientFactory::createOne([
            'uniteMesure' => UniteMesureFactory::createOne(),
            'sousFamilleIngredient' => $subFamily,
            'nomIng' => 'Abadèche',
        ]);

        $stock = StockFactory::createOne([
            'userStock' => $user->object(),
            'ingredient' => $ingredient->object(),
            'qteDispo' => 100,
            'uniteMesure' => 'sss',
        ]);

        $I->amLoggedInAs($user->object());
        $I->amOnPage('/profile/'.$user->getId().'/stock/');
        $I->click("a[href='/profile/{$user->getId()}/stock/{$stock->getId()}/delete']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/stock/'.$stock->getId().'/delete');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Suppression du stock de {$ingredient->getNomIng()}");
    }
}
