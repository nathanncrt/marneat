<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use App\Factory\EtapeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EtapeFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge les étapes d'une recette depuis un fichier JSON dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $recettes = $manager->getRepository(Recette::class)->findAll();

        foreach ($recettes as $recette) {
            $nombreEtapes = mt_rand(1, 10);

            for ($j = 1; $j <= $nombreEtapes; ++$j) {
                $description = "Description de l'étape $j de la recette '{$recette->getNomRecette()}'";
                EtapeFactory::new([
                    'descEtape' => $description,
                    'numEtape' => $j,
                    'recette' => $recette,
                    'imgEtape' => EtapeFactory::faker()->boolean(35) ? file_get_contents(EtapeFactory::faker()->image(sys_get_temp_dir(), 150, 150, 'food', true, true, 'recette')) : null,
                ])->create();

            }
        }
    }


    public function getDependencies(): array
    {
        return [
            RecetteFixtures::class,
        ];
    }
}
