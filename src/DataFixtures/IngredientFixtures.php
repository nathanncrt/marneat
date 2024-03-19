<?php

namespace App\DataFixtures;

use App\Entity\Allergene;
use App\Factory\AllergeneFactory;
use App\Factory\IngredientFactory;
use App\Factory\SousFamilleIngredientFactory;
use App\Factory\UniteMesureFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge les données des ingrédients depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/Ingredients.json';
        $ingredientsData = json_decode(file_get_contents($fileJson), true);

        foreach ($ingredientsData as $ingredient) {
            $uniteMesure = UniteMesureFactory::random();
            $sousFamilleIngredient = SousFamilleIngredientFactory::random();
            $ingredientFactory = IngredientFactory::new();

            AllergeneFactory::faker()->boolean(20) ? $ingredientFactory->create([
                'nomIng' => $ingredient['nomIng'],
                'allergene' => AllergeneFactory::random(),
                'unitemesure' => $uniteMesure,
                'sousFamilleIngredient' => $sousFamilleIngredient,
            ])
                : $ingredientFactory->create([
                'nomIng' => $ingredient['nomIng'],
                'unitemesure' => $uniteMesure,
                'sousFamilleIngredient' => $sousFamilleIngredient,
            ]);
        }
    }


    public function getDependencies(): array
    {
        return [
            UniteMesureFixtures::class,
            AllergeneFixtures::class,
            SousFamilleIngredientFixtures::class,
        ];
    }
}
