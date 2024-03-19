<?php

namespace App\Tests\Controller\Home;

use App\Tests\Support\ControllerTester;

class indexCest
{
    /** Test si le chemin et le titre de la page home sont ok.
     *
     */
    public function homePageResConform(ControllerTester $I): void
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : votre source d'inspiration culinaire");
    }
}
