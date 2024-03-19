<?php

namespace App\Controller;

use App\Entity\SousCategorieRecette;
use App\Repository\RecetteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SousCategorieRecetteController extends AbstractController
{
    #[Route('/sousCategorieRecette/{id}', name: 'app_sousCategorie_recette', requirements: ['id' => '\d+'])]
    public function index(SousCategorieRecette $recipeSubCategory,
        RecetteRepository $recipeRepository,
        Request $request,
        PaginatorInterface $paginator): Response
    {
        $subCategoryId = $recipeSubCategory->getId();

        $recipesPagination = $paginator->paginate(
            $recipeRepository->findRecipesBySubCatgeoryId($subCategoryId),
            $request->query->get('page', 1),
            30
        );

        return $this->render('sous_categorie_recette/index.html.twig', [
            'recipeSubCategory' => $recipeSubCategory,
            'recipes' => $recipesPagination,
        ]);
    }
}
