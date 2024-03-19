<?php

namespace App\Repository;

use App\Entity\Noter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Noter>
 *
 * @method Noter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noter[]    findAll()
 * @method Noter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noter::class);
    }

    /** Renvoie la moyenne de toutes les notes données à une recette (arrondit à la dixième près).
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findNoteByRecetteId(int $id): ?float
    {
        $qb = $this->createQueryBuilder('r');

        $note = $qb->select('AVG(n.note) as note')
            ->leftJoin('r.noters', 'n')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();

        // Arrondir la note récupérée à une décimale
        $roundedNote = round($note, 1);

        return $roundedNote;
    }

    //    /**
    //     * @return Noter[] Returns an array of Noter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Noter
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
