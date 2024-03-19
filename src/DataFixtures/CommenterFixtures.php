<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use App\Factory\CommenterFactory;
use App\Factory\RecetteFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommenterFixtures extends Fixture implements DependentFixtureInterface
{
    /** Charge des commentaires factices pour une recette dans la base de données.
     *
     */
    public function load(ObjectManager $manager): void
    {
        $recettes = $manager->getRepository(Recette::class)->findAll();

        foreach ($recettes as $recette) {

            $nombreComm = mt_rand(1, 3);

            for ($j = 0; $j <= $nombreComm; ++$j) {
                CommenterFactory::new([
                    'recette' => $recette,
                    'userComm' => UserFactory::random(),
                ])->create();
            }

        }
    }


    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            RecetteFixtures::class,
        ];
    }
}
