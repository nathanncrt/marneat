<?php

namespace App\Repository;

use App\Entity\StockCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StockCollection>
 *
 * @method StockCollection|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockCollection|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockCollection[]    findAll()
 * @method StockCollection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockCollectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StockCollection::class);
    }

//    /**
//     * @return StockCollection[] Returns an array of StockCollection objects
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

//    public function findOneBySomeField($value): ?StockCollection
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
