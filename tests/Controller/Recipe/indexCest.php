<?php

namespace App\Tests\Controller\Recipe;

use App\Tests\Support\ControllerTester;

class indexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si on peut accéder à la ressource ('/recettes').
     *
     */
    public function seeCatalogueRecetteAsResConforme(ControllerTester $I): void
    {
        $I->amOnPage('/recettes');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : Catalogue des recettes");
    }
}
