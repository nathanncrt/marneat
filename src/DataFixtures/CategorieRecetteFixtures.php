<?php

namespace App\DataFixtures;

use App\Entity\CategorieRecette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieRecetteFixtures extends Fixture
{
    /** Charge les catégories de recette depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/CategorieRecette.json';
        $categoriesData = json_decode(file_get_contents($fileJson), true);

        foreach ($categoriesData as $categoryData) {
            $categorieRecette = new CategorieRecette();
            $categorieRecette->setLibCatRecette($categoryData['libCatRecette']);

            $manager->persist($categorieRecette);

            $this->addReference($categoryData['libCatRecette'], $categorieRecette);
        }

        $manager->flush();
    }
}
