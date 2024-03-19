<?php

namespace App\Tests\Controller\Register;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class registerCest
{
    // tests
    /** Teste si un visiteur peut accéder à la ressource '/register'.
     *
     */
    public function visitorCanTryToRegister(ControllerTester $I): void
    {
        $I->amOnPage('/register');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Inscription - Marn'Eat");
    }

    /** Teste si un utilisateur enregistré ne peut pas accéder à la ressource '/register'. Il sera redirigé vers la ressource '/'.
     *
     */
    public function userAccessRegister(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.bart',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Bart',
        ]);

        $I->amLoggedInAs($user->object());
        $I->amOnPage('/register');
        $I->seeCurrentUrlEquals('/');
        $I->seeInTitle("Marn'Eat : votre source d'inspiration culinaire");

    }
}
