<?php

namespace App\DataFixtures;

use App\Factory\IngredientFactory;
use App\Factory\StockFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StockFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge des stocks factices d'un utilisateur dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        StockFactory::createMany(5, function () {
            return [
                'userStock' => UserFactory::random(),
                'ingredient' => IngredientFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            IngredientFixtures::class,
        ];
    }
}
