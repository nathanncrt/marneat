<?php

namespace App\Controller;

use App\Entity\CategorieRecette;
use App\Repository\CategorieRecetteRepository;
use App\Repository\RecetteRepository;
use App\Repository\SousCategorieRecetteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieRecetteController extends AbstractController
{
    #[Route('/categorieRecette', name: 'app_categorie_recette')]
    public function index(CategorieRecetteRepository $categorieRecetteRepository): Response
    {
        $categories = $categorieRecetteRepository->findAll();

        return $this->render('categorie_recette/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categorieRecette/{id}', name : 'app_categoriesRecettes_show', requirements: ['id' => '\d+'])]
    public function show(SousCategorieRecetteRepository $subRecipeCategorieRepository,
        RecetteRepository $recipeRepository,
        CategorieRecette $recipeCategorie,
        Request $request,
        PaginatorInterface $paginator): Response
    {
        $categorieId = $recipeCategorie->getId();
        $subCategories = $subRecipeCategorieRepository->findSousCatByCategorieId($categorieId);
        $recipesPagination = $paginator->paginate(
            $recipeRepository->findRecipesByCategorieId($categorieId),
            $request->query->get('page', 1),
            30
        );
        return $this->render('categorie_recette/show.html.twig', [
            'categorieRecette' => $recipeCategorie,
            'subCategories' => $subCategories,
            'recipes' => $recipesPagination]);
    }
}
