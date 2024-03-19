<?php

namespace App\Tests\Controller\Profil;

use App\Factory\FamilleIngredientFactory;
use App\Factory\IngredientFactory;
use App\Factory\SousFamilleIngredientFactory;
use App\Factory\StockFactory;
use App\Factory\UniteMesureFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class stockCest
{
    // tests
    /** Teste si un utilisateur peut accéder à la page d'édition de la quantité d'un ingrédient de son stock.
     *
     */
    public function userCanAccessToIsStockPage(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.bart',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Bart',
        ]);


        $I->amLoggedInAs($user->object());
        $I->amOnPage('/profile/'.$user->getId());
        $I->click("a[href='/profile/{$user->getId()}/stock']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/stock');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Mon frigo");
    }
}
