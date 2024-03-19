<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient/{id}', name: 'app_ingredient_show', requirements: ['id' => '\d+'])]
    public function show(Ingredient $ingredient, RecetteRepository $recetteRepository): Response
    {
        $allergene = $ingredient->getAllergene();
        $sousType = $ingredient->getSousFamilleIngredient();
        $type = $sousType->getFamilleIngredient();
        $ingId = $ingredient->getId();
        $recettes = $recetteRepository->findRecettebyIngredientId($ingId);

        return $this->render('ingredient/show.html.twig', [
            'type' => $type,
            'sousType' => $sousType,
            'ingredient' => $ingredient,
            'allergene' => $allergene,
            'recettes' => $recettes,
        ]);
    }

    #[Route('/ingredients/{searchLetter}', name: 'app_ingredient', requirements: ['searchLetter' => '[A-Z]'])]
    public function index(IngredientRepository $ingredientRepository,
        Request $request,
        PaginatorInterface $paginator,
        $searchLetter = 'A', ): Response
    {
        $ingredientsPagination = $paginator->paginate(
            $ingredientRepository->findIngredientByLetter($searchLetter),
            $request->query->get('page', 1),
            30
        );

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredientsPagination,
            'searchLetter' => $searchLetter,
        ]);
    }
}
