<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Stock;
use App\Entity\User;
use App\Form\CreateRecetteType;
use App\Form\NewStockType;
use App\Form\StockType;
use App\Form\UserType;
use App\Repository\RecetteRepository;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile', requirements: ['id' => '\d+'])]
    public function index(User $user): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        return $this->render('profile/profil.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profile/{id}/create-recette', name: 'app_profile_createrecette', requirements: ['id' => '\d+'])]
    public function createRecette(User $user,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $recette = new Recette();

        $recette->setUserCreator($user);

        $form = $this->createForm(CreateRecetteType::class, $recette);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recette->setDatePubli(new \DateTime());

            foreach (['TpsPrepa', 'TpsCuisson', 'TpsRepos'] as $tempsType) {
                $temps = $form[$tempsType]->getData();

                if (null !== $temps) {
                    $tempsArray = explode(':', $temps);
                    $heures = intval($tempsArray[0]);
                    $minutes = intval($tempsArray[1]);
                    $recette->{'set'.$tempsType}(new \DateTimeImmutable('@0'));
                    $recette->{'set'.$tempsType}($recette->{'get'.$tempsType}()->modify("+$heures hours +$minutes minutes"));
                }
            }

            $entityManager->persist($recette);

            $entityManager->flush();

            return $this->redirectToRoute('app_recipe_show', ['id' => $recette->getId()]);
        }

        return $this->render('profile/profil_create_recette.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/update', name: 'app_profile_update', requirements: ['id' => '\d+'])]
    public function update(User $user,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile instanceof UploadedFile) {
                $fileContent = file_get_contents($avatarFile->getPathname());

                $user->setAvatar($fileContent);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
        }

        return $this->render('profile/profil_update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/avatar-update', name: 'app_profile_update_avatar', requirements: ['id' => '\d+'])]
    public function updateAvatar(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createFormBuilder()
            ->add('avatar', FileType::class, [
                'label' => 'Nouvel avatar',
                'mapped' => false,
                'attr' => [
                    'accept' => '.png, .jpg, .jpeg',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier',
                'attr' => ['class' => 'btn btn-primary w-100 p-3'],
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarFile = $form->get('avatar')->getData();

            if ($avatarFile instanceof UploadedFile) {
                $fileContent = file_get_contents($avatarFile->getPathname());
                $user->setAvatar($fileContent);
                $entityManager->flush();

                return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
            }
        }

        return $this->render('profile/profil_update-avatar.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile/{id}/delete', name: 'app_profile_delete_account', requirements: ['id' => '\d+'])]
    public function deleteAccount(User $user,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createFormBuilder()
            ->add('annuler', SubmitType::class, ['label' => 'Annuler', 'attr' => ['class' => 'btn btn-outline-primary']])
            ->add('supprimer', SubmitType::class, ['label' => 'Me désinscrire', 'attr' => ['class' => 'btn btn-outline-danger']])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('supprimer')->isClicked()) {
                // Bouton supprimer cliqué
                $entityManager->remove($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_home');
            } else {
                return $this->redirectToRoute('app_profile', ['id' => $user->getId()]);
            }
        }

        return $this->render('profile/profil_delete.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/coup-de-coeur', name: 'app_profile_coupdecoeur', requirements: ['id' => '\d+'])]
    public function coupDeCoeur(User $user, RecetteRepository $recipeRepository): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $recipes = $recipeRepository->findRecetteByCoupCoeurUser($user->getId());

        return $this->render('profile/profil_coup-de-coeur.html.twig', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    #[Route('/profile/{id}/coup-de-coeur/{recipe_id}', name: 'app_profile_coup-de-coeur_delete', requirements: ['id' => '\d+'])]
    public function deleteCoupDeCoeur(User $user,
        #[MapEntity(id: 'recipe_id')] Recette $recipe,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createFormBuilder()
            ->add('annuler', SubmitType::class, ['label' => 'Annuler', 'attr' => ['class' => 'btn btn-outline-primary']])
            ->add('supprimer', SubmitType::class, ['label' => 'Supprimer', 'attr' => ['class' => 'btn btn-outline-danger']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('supprimer')->isClicked()) {
                // Bouton supprimer cliqué
                $user->removeRecettesCoupsCoeur($recipe);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_profile_coupdecoeur', ['id' => $user->getId()]);
        }

        return $this->render('profile/profil_coup-de-coeur_delete.html.twig', [
            'recipe' => $recipe,
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/stock', name: 'app_profile_stock', requirements: ['id' => '\d+'])]
    public function stock(User $user, StockRepository $stockRepository, Request $request, PaginatorInterface $paginator): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $stockPagination = $paginator->paginate(
            $stockRepository->findStockByUserId($user->getId()),
            $request->query->get('page', 1),
            12
        );

        return $this->render('profile/stock.html.twig', [
            'user' => $user,
            'stock' => $stockPagination]);
    }

    #[Route('/profile/{id}/stock/create', name: 'app_profile_stock_create', requirements: ['id' => '\d+'])]
    public function stockCreate(User $user,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $newStock = new Stock();

        $newStock->setUserStock($user);

        $form = $this->createForm(NewStockType::class, $newStock);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newStock);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_stock', ['id' => $user->getId()]);
        }

        return $this->render('profile/stock_create.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/stock/{stock_id}/update', name: 'app_profile_stock_update', requirements: ['id' => '\d+'])]
    public function stockUpdate(User $user,
        #[MapEntity(id: 'stock_id')] Stock $stock, Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createForm(StockType::class, $stock);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_stock', ['id' => $user->getId()]);
        }

        return $this->render('profile/stock_update.html.twig', [
            'user' => $user,
            'stock' => $stock,
            'form' => $form,
        ]);
    }

    #[Route('/profile/{id}/stock/{stock_id}/delete', name: 'app_profile_stock_delete', requirements: ['id' => '\d+'])]
    public function stockDelete(User $user,
        #[MapEntity(id: 'stock_id')] Stock $stock,
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        }

        $form = $this->createFormBuilder()
            ->add('annuler', SubmitType::class, ['label' => 'Annuler', 'attr' => ['class' => 'btn btn-outline-primary']])
            ->add('supprimer', SubmitType::class, ['label' => 'Supprimer', 'attr' => ['class' => 'btn btn-outline-danger']])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('supprimer')->isClicked()) {
                // Bouton supprimer cliqué
                $entityManager->remove($stock);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_profile_stock', ['id' => $user->getId()]);
        }

        return $this->render('profile/stock_delete.html.twig', [
            'stock' => $stock,
            'user' => $user,
            'form' => $form,
        ]);
    }
}
