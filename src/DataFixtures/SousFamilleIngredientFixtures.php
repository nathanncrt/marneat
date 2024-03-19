<?php

namespace App\DataFixtures;

use App\Entity\SousFamilleIngredient;
use App\Factory\SousFamilleIngredientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SousFamilleIngredientFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge les données des sous-familles des ingrédients depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/SousFamilleIngredient.json';
        $sousFamilleIngredientData = json_decode(file_get_contents($fileJson), true);

        foreach ($sousFamilleIngredientData as $sousFamIng) {
            $sousFamilleIngredient = new SousFamilleIngredient();
            $sousFamilleIngredient->setLibSousFamImg($sousFamIng['libSousFamImg']);

            $categorieRecette = $this->getReference($sousFamIng['familleIngredient']['libFamIng']);

            $sousFamilleIngredient->setFamilleIngredient($categorieRecette);

            $manager->persist($sousFamilleIngredient);
        }

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            FamilleIngredientFixtures::class,
        ];
    }
}
