<?php

namespace App\Controller;

use App\Entity\Section;
use App\Repository\RecetteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    #[Route('/section/{id}', name: 'app_section_show', requirements: ['id' => '\d+'])]
    public function index(Section $section,
        RecetteRepository $recetteRepository,
        Request $request,
        PaginatorInterface $paginator): Response
    {
        $sectionId = $section->getId();
        $recipesPagination = $paginator->paginate(
            $recetteRepository->findRecettesBySectionId($sectionId),
            $request->query->get('page', 1),
            30
        );

        return $this->render('section/index.html.twig', [
            'section' => $section,
            'recipes' => $recipesPagination,
        ]);
    }
}
