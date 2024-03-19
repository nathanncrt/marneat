<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use App\Entity\UniteMesure;
use App\Factory\ContenirFactory;
use App\Factory\IngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContenirFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge contenir (la quantité, l'unité d'un ingrédient appartenant à une recette) depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $recettes = $manager->getRepository(Recette::class)->findAll();

        $uniteMesures = $manager->getRepository(UniteMesure::class)->findAll();

        foreach ($recettes as $recette) {
            $nombreIng = mt_rand(1, 6);

            for ($j = 0; $j <= $nombreIng; ++$j) {
                $randomIndex = array_rand($uniteMesures);
                $uniteMesure = $uniteMesures[$randomIndex];
                ContenirFactory::new([
                    'recette' => $recette,
                    'ingredient' => IngredientFactory::random(),
                    'uniteMesure' => "{$uniteMesure->getCodeUm()}, {$uniteMesure->getLibUm()}",
                ])->create();
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            RecetteFixtures::class,
            IngredientFixtures::class,
        ];
    }
}
