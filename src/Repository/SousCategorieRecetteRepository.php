<?php

namespace App\Repository;

use App\Entity\SousCategorieRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SousCategorieRecette>
 *
 * @method SousCategorieRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCategorieRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCategorieRecette[]    findAll()
 * @method SousCategorieRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCategorieRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategorieRecette::class);
    }

    public function findSousCatByCategorieId(int $categorieId): array
    {
        return $this->createQueryBuilder('sousCat')
            ->join('sousCat.categorieRecette', 'cat')
            ->where('cat.id = :categorieId')
            ->setParameter('categorieId', $categorieId)
            ->orderBy('sousCat.libSousCategorieRecette')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return SousCategorieRecette[] Returns an array of SousCategorieRecette objects
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

    //    public function findOneBySomeField($value): ?SousCategorieRecette
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
