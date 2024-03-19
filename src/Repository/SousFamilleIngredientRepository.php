<?php

namespace App\Repository;

use App\Entity\SousFamilleIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousFamilleIngredient>
 *
 * @method SousFamilleIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousFamilleIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousFamilleIngredient[]    findAll()
 * @method SousFamilleIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousFamilleIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousFamilleIngredient::class);
    }

    //    /**
    //     * @return SousFamilleIngredient[] Returns an array of SousFamilleIngredient objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SousFamilleIngredient
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
