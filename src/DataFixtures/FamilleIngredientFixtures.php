<?php

namespace App\DataFixtures;

use App\Entity\CategorieRecette;
use App\Entity\FamilleIngredient;
use App\Factory\FamilleIngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FamilleIngredientFixtures extends Fixture
{
    /** Charge les données des familles des ingrédients depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/FamilleIngredient.json';
        $familleIngredientsData = json_decode(file_get_contents($fileJson), true);

        foreach ($familleIngredientsData as $famIngData) {
            $familleIngredient = new FamilleIngredient();
            $familleIngredient->setLibFamIng($famIngData['libFamIng']);

            $manager->persist($familleIngredient);

            $this->addReference($famIngData['libFamIng'], $familleIngredient);
        }

        $manager->flush();
    }
}
