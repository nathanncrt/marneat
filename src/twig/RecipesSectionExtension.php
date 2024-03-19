<?php

namespace App\twig;

use App\Repository\RecetteRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RecipesSectionExtension extends AbstractExtension
{
    private RecetteRepository $repository;

    public function __construct(RecetteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('recipesSection', [$this, 'recipesSection']),
        ];
    }

    public function recipesSection($sectionId): array
    {
        return $this->repository->fourRecipesBySectionId($sectionId);
    }
}
