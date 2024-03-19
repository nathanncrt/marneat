<?php

namespace App\Tests\Controller\Security;

use App\Tests\Support\ControllerTester;

class loginCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si un visiteur peut accéder à la ressource ('/login').
     *
     * @return void
     */
    public function canAccessToLoginForm(ControllerTester $I): void
    {
        $I->amOnPage('/login');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Connexion - Marn'Eat");
    }
}
