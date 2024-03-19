<?php

namespace App\DataFixtures;

use App\Entity\SousCategorieRecette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SousCategorieRecetteFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge les données des sous-catégories des ingrédients depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/SousCategorieRecette.json';
        $sousCategorieRecetteData = json_decode(file_get_contents($fileJson), true);

        foreach ($sousCategorieRecetteData as $sousCatRec) {
            $sousCategorieRecette = new SousCategorieRecette();
            $sousCategorieRecette->setLibSousCategorieRecette($sousCatRec['libSousCategorieRecette']);

            $categorieRecette = $this->getReference($sousCatRec['categorieRecette']['libCatRecette']);

            $sousCategorieRecette->setCategorieRecette($categorieRecette);

            $manager->persist($sousCategorieRecette);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategorieRecetteFixtures::class,
        ];
    }
}
