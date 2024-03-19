<?php

namespace App\Repository;

use App\Entity\Contenir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contenir>
 *
 * @method Contenir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contenir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contenir[]    findAll()
 * @method Contenir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenir::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findQuantityAndUnitByRecetteAndIngredient(int $recetteId, int $ingredientId): ?array
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c.qteIngredients', 'c.uniteMesure')
            ->leftJoin('c.recette', 'r')
            ->leftJoin('c.ingredient', 'i')
            ->where('r.id = :recetteId')
            ->andWhere('i.id = :ingredientId')
            ->setParameter('recetteId', $recetteId)
            ->setParameter('ingredientId', $ingredientId)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }



    //    /**
    //     * @return Contenir[] Returns an array of Contenir objects
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

    //    public function findOneBySomeField($value): ?Contenir
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
