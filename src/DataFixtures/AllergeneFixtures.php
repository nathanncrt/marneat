<?php

namespace App\DataFixtures;

use App\Factory\AllergeneFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AllergeneFixtures extends Fixture
{
    /** Charge les allergènes depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/Allergene.json';
        $allergenes = json_decode(file_get_contents($fileJson), true);
        AllergeneFactory::createSequence($allergenes);
    }
}
