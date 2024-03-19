<?php

namespace App\DataFixtures;

use App\Factory\UstensileFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UstensileFixtures extends Fixture
{
    /** Charge les données des ustensiles depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/Ustensiles.json';
        $ustensile = json_decode(file_get_contents($fileJson), true);
        UstensileFactory::createSequence($ustensile);
    }
}
