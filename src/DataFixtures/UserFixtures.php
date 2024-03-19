<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /** Charge des utilisateurs factices dans la base de donnnées.
     *
     */
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(47);

        // Création des comptes pour les membres du projet
        UserFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
            'emailPers' => 'quentin.lahousse@example.com',
            'username' => 'quentin.lahousse',
            'password' => 'test',
            'nomPers' => 'LAHOUSSE',
            'pnomPers' => 'Quentin',
            'dateNais' => new \DateTime('2004-11-23'),
            'telPers' => '0606060606',
            'cpPers' => '51100',
            'adrPers' => 'Chem. des Rouliers',
            'villePers' => 'Reims',
            'avatar' => '',
        ]);

        UserFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
            'emailPers' => 'romain.crevet@example.com',
            'username' => 'romain.crevet',
            'password' => 'test',
            'nomPers' => 'CREVET',
            'pnomPers' => 'Romain',
            'dateNais' => new \DateTime('2004-01-09'),
            'telPers' => '0606060606',
            'cpPers' => '51100',
            'adrPers' => 'Chem. des Rouliers',
            'villePers' => 'Reims',
            'avatar' => '',
        ]);

        UserFactory::createOne([
            'roles' => ['ROLE_ADMIN'],
            'emailPers' => 'nathan.nicart@example.com',
            'username' => 'nathan.nicart',
            'password' => 'test',
            'nomPers' => 'NICART',
            'pnomPers' => 'Nathan',
            'dateNais' => new \DateTime('2004-04-07'),
            'telPers' => '0606060606',
            'cpPers' => '51100',
            'adrPers' => 'Chem. des Rouliers',
            'villePers' => 'Reims',
            'avatar' => '',
            ]);

        // Création d'un utilisateur où on va pouvoir tester les affichages, restrictions etc ...
        UserFactory::createOne([
            'roles' => ['ROLE_USER'],
            'emailPers' => 'user@example.com',
            'username' => 'simpson.marge',
            'password' => 'test',
            'nomPers' => 'SIMPSON',
            'pnomPers' => 'Marge',
            'dateNais' => new \DateTime('1989-12-17'),
            'telPers' => '0606060606',
            'cpPers' => '51100',
            'adrPers' => 'Chem. des Rouliers',
            'villePers' => 'Reims',
            'avatar' => '',
        ]);
    }
}
