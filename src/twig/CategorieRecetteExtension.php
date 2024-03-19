<?php

namespace App\twig;

use App\Repository\CategorieRecetteRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CategorieRecetteExtension extends AbstractExtension
{
    private CategorieRecetteRepository $repository;

    public function __construct(CategorieRecetteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('list_category', [$this, 'listCategory']),
        ];
    }

    public function listCategory(): array
    {
        return $this->repository->getAllOrdered();
    }
}
