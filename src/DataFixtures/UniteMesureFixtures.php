<?php

namespace App\DataFixtures;

use App\Factory\UniteMesureFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UniteMesureFixtures extends Fixture
{
    /** Charge les données des unités de mesure depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/UniteMesure.json';
        $UniteMesure = json_decode(file_get_contents($fileJson), true);
        UniteMesureFactory::createSequence($UniteMesure);
    }
}
