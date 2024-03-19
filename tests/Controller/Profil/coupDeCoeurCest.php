<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class coupDeCoeurCest
{

    // tests
    /** Teste si un utilisateur peut avoir accès à ses coups de cœur.
     *
     */
    public function userCanAccessToCoupDeCoeurPage(ControllerTester $I): void
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

        $I->click("a[href='/profile/{$user->getId()}/coup-de-coeur']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/coup-de-coeur');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Mes coups de coeur');
    }
}
