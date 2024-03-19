<?php

namespace App\Repository;

use App\Entity\Commenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commenter>
 *
 * @method Commenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commenter[]    findAll()
 * @method Commenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commenter::class);
    }

    /** Retourne les commentaires écris par un utilisateur.
     */
    public function findCommentsByRecetteId(int $id): array
    {
        return $this->createQueryBuilder('c')
            ->select('c, u')
            ->leftJoin('c.recette', 'r')
            ->leftJoin('c.userComm', 'u')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Commenter[] Returns an array of Commenter objects
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

    //    public function findOneBySomeField($value): ?Commenter
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
