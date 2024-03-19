<?php

namespace App\Controller;

use App\Repository\SectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SectionRepository $repository): Response
    {
        $sections = $repository->findBy([], ['libSec' => 'asc']);

        return $this->render('home/index.html.twig', ['sections' => $sections]);
    }


}
