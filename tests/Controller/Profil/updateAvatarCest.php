<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class updateAvatarCest
{
    // tests
    /** Teste si un utilisateur peut avoir accès au formulaire de modification de sa photo de profil.
     *
     */
    public function userCanAccessToAvatarUpdatePage(ControllerTester $I): void
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

        $I->click("a[href='/profile/{$user->getId()}/avatar-update']");

        $I->seeCurrentUrlEquals('/profile/'.$user->getId().'/avatar-update');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Modification de votre photo de profil');
    }
}
