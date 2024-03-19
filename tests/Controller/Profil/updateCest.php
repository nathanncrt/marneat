<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class updateCest
{
    // tests
    /** Teste si un utilisateur peut avoir accès au formulaire de modification de ses informations personnelles.
     *
     */
    public function userCanAccessToProfilUpdatePage(ControllerTester $I): void
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

        $I->click("a[href='/profile/{$user->getId()}/update']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/update');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Mes informations');
    }
}
