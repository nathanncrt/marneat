<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function findRecettebyIngredientId(int $id): array
    {
        $qb = $this->createQueryBuilder('r');

        $qb->select('r')
            ->innerJoin('r.contenirs', 'c')
            ->innerJoin('c.ingredient', 'i')
            ->where('i.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function findAverageNoteByRecetteId(int $recetteId): ?float
    {
        $qb = $this->createQueryBuilder('r');

        $averageNote = $qb->select('AVG(n.note) as averageNote')
            ->leftJoin('r.noters', 'n')
            ->where('r.id = :id')
            ->setParameter('id', $recetteId)
            ->getQuery()
            ->getSingleScalarResult();

        return $averageNote ? round($averageNote, 1) : null;
    }

    public function findRecetteByUserId(int $userId): ?array
    {
        $qb = $this->createQueryBuilder('r')
            ->join('r.userCreator', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $userId)
            ->orderBy('r.id', 'ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findRecetteByCoupCoeurUser(int $userId): ?array
    {
        $qb = $this->createQueryBuilder('r')
            ->join('r.users', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $userId)
            ->orderBy('r.id', 'ASC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findRecipesByCategorieId(int $categoryId)
    {
        return $this->createQueryBuilder('r')
            ->join('r.sousCategorieRecette', 'scr')
            ->join('scr.categorieRecette', 'cr')
            ->where('cr.id = :categorieId')
            ->setParameter('categorieId', $categoryId)
            ->orderBy('r.nomRecette')
            ->getQuery();
    }

    public function findRecipesBySubCatgeoryId(int $subCategoryId): array
    {
        return $this->createQueryBuilder('r')
            ->join('r.sousCategorieRecette', 'scr')
            ->where('scr.id = :subCategoryId')
            ->setParameter('subCategoryId', $subCategoryId)
            ->orderBy('r.nomRecette')
            ->getQuery()
            ->getResult();
    }


    public function paginationQuery(): Query
    {
        return $this->createQueryBuilder('recette')
            ->orderBy('recette.nomRecette', 'ASC')
            ->getQuery();
    }

    public function findRecettesBySectionId(int $sectionId)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.sections', 's')
            ->andWhere('s.id = :sectionId')
            ->setParameter('sectionId', $sectionId)
            ->getQuery();
    }

    public function getRecettesFiltres($categorie, $sousCategorie, $ingredient, $allergene)
    {
        $queryBuilder = $this->createQueryBuilder('r');

        if (null !== $categorie) {
            $queryBuilder
                ->join('r.sousCategorieRecette', 'scr')
                ->join('scr.categorieRecette', 'cr')
                ->where('cr.id = :categorieId')
                ->setParameter('categorieId', $categorie);
        }

        if (null !== $sousCategorie) {
            $queryBuilder
                ->join('r.sousCategorieRecette', 'scr')
                ->where('scr.id = :subCategoryId')
                ->setParameter('subCategoryId', $sousCategorie);
        }

        if (null !== $ingredient) {
            $queryBuilder
                ->join('r.contenirs', 'c')
                ->join('c.ingredient', 'i')
                ->andWhere('i.id = :ingredient')
                ->setParameter('ingredient', $ingredient);

        }

        if (null !== $allergene) {
            $queryBuilder
                ->leftJoin('r.contenirs', 'c')
                ->leftJoin('c.ingredient', 'i')
                ->leftJoin('i.allergene', 'a')
                ->where($queryBuilder->expr()->not($queryBuilder->expr()->eq('a.id', ':allergeneId')))
                ->setParameter('allergeneId', $allergene);
        }

        return $queryBuilder->orderBy('r.nomRecette')->getQuery()->getResult();
    }

    public function search(string $search): array
    {
        $qb = $this->createQueryBuilder('r')
            ->where('r.nomRecette LIKE :search')
            ->orderBy('r.nomRecette', 'ASC')
            ->setParameter(':search', "%{$search}%");

        $query = $qb->getQuery();

        return $query->execute();
    }

    public function fourRecipesBySectionId(int $sectionId)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.sections', 's')
            ->andWhere('s.id = :sectionId')
            ->setParameter('sectionId', $sectionId)
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Recette[] Returns an array of Recette objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Recette
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
