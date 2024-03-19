<?php

namespace App\Tests\Controller\Section;

use App\Factory\SectionFactory;
use App\Tests\Support\ControllerTester;

class indexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests

    /** Teste si on peut acceder à la ressource ('/section/id').
     *
     * @param ControllerTester $I
     * @return void
     */
    public function sectionPageAsResConform(ControllerTester $I): void
    {
        $section = SectionFactory::createOne([
            'libSec' => 'La section',
        ]);

        $I->amOnPage('/section/'.$section->getId());
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Marn'Eat : {$section->getLibSec()}");
    }
}
