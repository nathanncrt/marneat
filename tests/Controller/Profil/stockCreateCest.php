<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class stockCreateCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si un utilisateur peut avoir accès au formulaire de création de d'un ingrédient dans son stock.
     *
     */
    public function userCanCreateAStock(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.bart',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Bart',
        ]);

        $I->amLoggedInAs($user->object());
        $I->amOnPage('/profile/'.$user->getId().'/stock');

        $I->click("a[href='/profile/{$user->getId()}/stock/create']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/stock/create');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Ajout d'un nouvel ingredient");
    }
}
