<?php

namespace App\Controller\Admin;

use App\Entity\Allergene;
use App\Entity\CategorieRecette;
use App\Entity\FamilleIngredient;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Section;
use App\Entity\SousCategorieRecette;
use App\Entity\SousFamilleIngredient;
use App\Entity\UniteMesure;
use App\Entity\User;
use App\Entity\Ustensile;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $currentUser = $this->getUser();

        return $this->render('admin/index.html.twig', ['user' => $currentUser]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("BackOffice Marn'Eat")
            ->setFaviconPath('img/marneat.png')
        ;
    }

    public function configureCrud(): \EasyCorp\Bundle\EasyAdminBundle\Config\Crud
    {
        return parent::configureCrud()
            ->showEntityActionsInlined();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Allergènes', 'fa-solid fa-hand-dots ', Allergene::class);
        yield MenuItem::linkToCrud('Catégories Recettes', 'fa-regular fa-rectangle-list', CategorieRecette::class);
        yield MenuItem::linkToCrud('Familles Ingredients', 'fa-regular fa-rectangle-list', FamilleIngredient::class);
        yield MenuItem::linkToCrud('Ingrédients', 'fa-solid fa-burger', Ingredient::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-regular fa-user', User::class);
        yield MenuItem::linkToCrud('Recettes', 'fa-solid fa-utensils', Recette::class);
        yield MenuItem::linkToCrud('Sections', 'fa-solid fa-box-open', Section::class);
        yield MenuItem::linkToCrud('Sous Categories Recettes', 'fa-solid fa-table', SousCategorieRecette::class);
        yield MenuItem::linkToCrud('Sous Familles Ingredients', 'fa-solid fa-table', SousFamilleIngredient::class);
        yield MenuItem::linkToCrud('Unités Mesures', 'fas fa-solid fa-ruler', UniteMesure::class);
        yield MenuItem::linkToCrud('Ustensiles', 'fas fa-solid fa-kitchen-set', Ustensile::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
