<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use App\Factory\ImageRecetteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageRecetteFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge des images de recette factices dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $recettes = $manager->getRepository(Recette::class)->findAll();

        foreach ($recettes as $recette) {
            $nombreImg = mt_rand(0, 3);

            if (0 !== $nombreImg) {
                for ($j = 1; $j <= $nombreImg; ++$j) {
                    ImageRecetteFactory::new([
                        'recette' => $recette,
                    ])->create();
                }
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
