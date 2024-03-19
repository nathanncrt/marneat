<?php

namespace App\DataFixtures;

use App\Factory\NoterFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NoterFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge des notes factices d'une recette dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        NoterFactory::createMany(500, function () {
            return [
                'userNote' => UserFactory::random(),
                'recette' => RecetteFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            RecetteFixtures::class,
        ];
    }
}
