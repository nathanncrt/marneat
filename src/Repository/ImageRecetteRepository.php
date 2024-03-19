<?php

namespace App\Repository;

use App\Entity\ImageRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageRecette>
 *
 * @method ImageRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageRecette[]    findAll()
 * @method ImageRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageRecette::class);
    }

    public function findImageRecetteByRecetteId(int $recetteId): ?array
    {
        $qb = $this->createQueryBuilder('ir')
            ->join('ir.recette', 'r')
            ->where('r.id = :id')
            ->setParameter('id', $recetteId)
            ->orderBy('r.id', 'ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    //    /**
    //     * @return ImageRecette[] Returns an array of ImageRecette objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ImageRecette
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
