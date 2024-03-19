<?php

namespace App\Repository;

use App\Entity\CategorieRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieRecette>
 *
 * @method CategorieRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieRecette[]    findAll()
 * @method CategorieRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRecette::class);
    }

    public function getAllOrdered(): array
    {
        $qb = $this->createQueryBuilder('c')
                                        ->orderBy('c.libCatRecette', 'ASC');

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return CategorieRecette[] Returns an array of CategorieRecette objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CategorieRecette
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
