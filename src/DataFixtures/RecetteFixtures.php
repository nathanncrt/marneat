<?php

namespace App\DataFixtures;

use App\Factory\RecetteFactory;
use App\Factory\SectionFactory;
use App\Factory\SousCategorieRecetteFactory;
use App\Factory\UserFactory;
use App\Factory\UstensileFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RecetteFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge les données des recettes depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $fileJson = __DIR__.'/data/Recettes.json';
        $recettesData = json_decode(file_get_contents($fileJson), true);

        foreach ($recettesData as &$recette) {
            foreach (['tpsPrepa', 'tpsCuisson', 'tpsRepos'] as $temps) {
                if ('null' !== $recette[$temps]) {
                    $tempsArray = explode(':', $recette[$temps]);
                    $heures = intval($tempsArray[0]);
                    $minutes = intval($tempsArray[1]);
                    $recette[$temps] = new \DateTimeImmutable('@0');
                    $recette[$temps] = $recette[$temps]->modify("+$heures hours +$minutes minutes");
                } else {
                    $recette[$temps] = null;
                }
            }
        }
        foreach ($recettesData as $recetteData) {
            $userCreator = UserFactory::random();
            $sousCategorieRecette = SousCategorieRecetteFactory::random();
            $sections = SectionFactory::randomRange(0, 3);
            $ustensiles = UstensileFactory::randomRange(2, 5);
            $users = UserFactory::randomRange(1, 7);
            $recetteFactory = RecetteFactory::new();
            $recetteFactory->create([
                'nomRecette' => $recetteData['nomRecette'],
                'descRecette' => $recetteData['descRecette'],
                'tpsPrepa' => $recetteData['tpsPrepa'],
                'tpsCuisson' => $recetteData['tpsCuisson'],
                'tpsRepos' => $recetteData['tpsRepos'],
                'nb_pers' => $recetteData['nombrePers'],
                'userCreator' => $userCreator,
                'sousCategorieRecette' => $sousCategorieRecette,
                'sections' => $sections,
                'ustensiles' => $ustensiles,
                'users' => $users,
            ]);
        }
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            SousCategorieRecetteFixtures::class,
            SectionFixtures::class,
            UstensileFixtures::class,
        ];
    }
}
