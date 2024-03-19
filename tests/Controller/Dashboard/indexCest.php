<?php

namespace App\Tests\Controller\Dashboard;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class indexCest
{
    /** Teste si un utilisateur qui possède un role ['ROLE_USER'] ne peut pas accéder à la ressource '/admin'.
     *
     */
    public function userAccessToDashBoard(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.bart',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Bart',
        ]);
        $I->amLoggedInAs($user->object());
        $I->amOnPage('/admin');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    /** Teste si un utilisateur qui possède un role ['ROLE_ADMIN'] peut accéder à la ressource '/admin'.
     *
     */
    public function adminAccessToDashBoard(ControllerTester $I): void
    {
        $user = UserFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
            'emailPers' => 'admin@example.com',
            'username' => 'simpson.homer',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Homer',
        ]);
        $I->amLoggedInAs($user->object());
        $I->amOnPage('/admin');
        $I->seeResponseCodeIsSuccessful();
    }
}
