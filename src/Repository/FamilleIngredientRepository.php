<?php

namespace App\Repository;

use App\Entity\FamilleIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FamilleIngredient>
 *
 * @method FamilleIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method FamilleIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method FamilleIngredient[]    findAll()
 * @method FamilleIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilleIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FamilleIngredient::class);
    }

    //    /**
    //     * @return FamilleIngredient[] Returns an array of FamilleIngredient objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FamilleIngredient
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
