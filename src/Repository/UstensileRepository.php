<?php

namespace App\Repository;

use App\Entity\Ustensile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ustensile>
 *
 * @method Ustensile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ustensile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ustensile[]    findAll()
 * @method Ustensile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UstensileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ustensile::class);
    }

    public function findUstensilesByRecetteId(int $id): array
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->leftJoin('u.recettes', 'r')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Ustensile[] Returns an array of Ustensile objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Ustensile
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
