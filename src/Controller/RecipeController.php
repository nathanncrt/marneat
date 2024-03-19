<?php

namespace App\Controller;

use App\Entity\Commenter;
use App\Entity\Noter;
use App\Entity\Recette;
use App\Form\CommType;
use App\Form\FilterType;
use App\Form\NoteType;
use App\Repository\AllergeneRepository;
use App\Repository\CommenterRepository;
use App\Repository\ContenirRepository;
use App\Repository\EtapeRepository;
use App\Repository\ImageRecetteRepository;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use App\Repository\UstensileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RecipeController extends AbstractController
{
    #[Route('/recettes', name: 'app_recipe')]
    public function index(RecetteRepository $recipeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $form = $this->createForm(FilterType::class);
        $form->add('cancel', SubmitType::class);

        $form->handleRequest($request);

        $recipes = $paginator->paginate(
            $recipeRepository->search($request->get('search', '')),
            $request->query->get('page', 1),
            30
        );

        $pageBool = true;

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->getClickedButton() && 'cancel' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('app_recipe');
            }
            $recipes = $recipeRepository->getRecettesFiltres(
                $form['categorieRecette']->getData(),
                $form['sousCategorieRecette']->getData(),
                $form['ingredients']->getData(),
                $form['allergenes']->getData()
            );

            $recipes = $paginator->paginate(
                $recipes,
                $request->query->get('page', 1),
                30000
            );

            $pageBool = false;
        }

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'form' => $form,
            'search' => $request->get('search'),
            'paginatorOptions' => [
                'style' => 'custom-pagination'],
            'pageBool' => $pageBool,
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/recette/{id}', name: 'app_recipe_show', requirements: ['id' => '\d+'])]
    public function show(Recette $recipe,
        IngredientRepository $ingredientRepository,
        EtapeRepository $etapeRepository,
        UstensileRepository $ustensileRepository,
        CommenterRepository $commenterRepository,
        RecetteRepository $recetteRepository,
        ImageRecetteRepository $imageRecetteRepository,
        ContenirRepository $contenirRepository,
        Commenter $commenter,
        AllergeneRepository $allergeneRepository): Response
    {
        $recipeId = $recipe->getId();
        $author = $recipe->getUserCreator();
        $contenir = $recipe->getContenirs();
        $ingredients = $ingredientRepository->findIngredientByRecetteId($recipeId);
        $steps = $etapeRepository->findEtapeByRecetteId($recipeId);
        $numberSteps = count($steps);
        $utensils = $ustensileRepository->findUstensilesByRecetteId($recipeId);
        $comments = $commenterRepository->findCommentsByRecetteId($recipeId);
        $averageNote = $recetteRepository->findAverageNoteByRecetteId($recipeId);
        $commentAuthor = $commenter->getUserComm();
        $images = $imageRecetteRepository->findImageRecetteByRecetteId($recipeId);

        $allergenes = $allergeneRepository->allergeneForRecipe($ingredients);

        $quantitiesAndUnits = [];
        foreach ($ingredients as $ingredient) {
            $ingredientId = $ingredient->getId();
            $quantityAndUnit = $contenirRepository->findQuantityAndUnitByRecetteAndIngredient($recipeId, $ingredientId);
            $quantitiesAndUnits[$ingredientId] = $quantityAndUnit;
        }

        return $this->render('recipe/show.html.twig', [
            'auteur' => $author,
            'recette' => $recipe,
            'etapes' => $steps,
            'totalEtapes' => $numberSteps,
            'ingredients' => $ingredients,
            'ustensiles' => $utensils,
            'contenir' => $contenir,
            'commentaire' => $comments,
            'commentaireAuteur' => $commentAuthor,
            'noteMoy' => $averageNote,
            'imagesRecette' => $images,
            'quantitiesAndUnits' => $quantitiesAndUnits,
            'allergenes' => $allergenes,
        ]);
    }

    #[Route('/recette/{id}/add-comment', name: 'app_recipe_comment', requirements: ['id' => '\d+'])]
    public function addComment(UserInterface $user,
        Recette $recipe,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        $newComment = new Commenter();
        $newComment->setUserComm($user);
        $newComment->setRecette($recipe);

        $form = $this->createForm(CommType::class, $newComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newComment->setDatePubli(new \DateTime());
            $entityManager->persist($newComment);
            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe/addComment.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recette/{id}/add-note', name: 'app_recipe_note', requirements: ['id' => '\d+'])]
    public function addNote(UserInterface $user,
        Recette $recipe,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        $newNote = new Noter();
        $newNote->setUserNote($user);
        $newNote->setRecette($recipe);

        $form = $this->createForm(NoteType::class, $newNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newNote);
            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe/addNote.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recette/{id}/add-coup-de-coeur', name: 'app_recipe_coup-de-coeur', requirements: ['id' => '\d+'])]
    public function addLike(UserInterface $user,
        Recette $recipe,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        $form = $this->createFormBuilder()
            ->add('annuler', SubmitType::class, ['label' => 'Annuler', 'attr' => ['class' => 'btn btn-secondary']])
            ->add('ajouter', SubmitType::class, ['label' => 'Ajouter', 'attr' => ['class' => 'btn btn-success']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('ajouter')->isClicked()) {
                // Bouton Ajouter cliqué
                $user->addRecettesCoupsCoeur($recipe);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe/addLike.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }
}
