<?php

namespace App\Tests\Controller\Profil;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class indexCest
{
    /** Teste si un utilisateur peut bien avoir accès à sa page de profil.
     *
     */
    public function userCanAccessToIsProfilPage(ControllerTester $I): void
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
        $I->seeInTitle('Profil de '.$user->getUsername());
    }
}
