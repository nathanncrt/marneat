<?php

namespace App\DataFixtures;

use App\Factory\SectionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SectionFixtures extends Fixture
{
    /** Charge les données des sections de la page d'accueil depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        SectionFactory::createSequence(
            [
                ['libSec' => 'A la Une'],
                ['libSec' => 'Recettes de saison'],
                ['libSec' => 'Recettes à la mode'],
                ['libSec' => 'Dernières Recettes Publiées'],
                ['libSec' => 'Nos coups de coeur'],
                ['libSec' => 'Gastronomie'],
                ['libSec' => 'Pour les flemmards'],
            ]
        );
    }
}
