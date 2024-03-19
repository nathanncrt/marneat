<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class deleteAccountCest
{
    // tests
    /** Teste si un utilisateur peut avoir accès au formulaire de désinscription.
     *
     */
    public function userCanAccessToDeleteAccountPage(ControllerTester $I): void
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

        $I->click("a[href='/profile/{$user->getId()}/delete']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/delete');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Se désinscrire');
    }
}
