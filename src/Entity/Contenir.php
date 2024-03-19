<?php

namespace App\Entity;

use App\Repository\ContenirRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenirRepository::class)]
class Contenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $qteIngredients = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recette $recette = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    #[ORM\Column(length: 100)]
    private ?string $uniteMesure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteIngredients(): ?float
    {
        return $this->qteIngredients;
    }

    public function setQteIngredients(float $qteIngredients): static
    {
        $this->qteIngredients = $qteIngredients;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): static
    {
        $this->recette = $recette;

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    public function getUniteMesure(): ?string
    {
        return $this->uniteMesure;
    }

    public function setUniteMesure(string $uniteMesure): static
    {
        $this->uniteMesure = $uniteMesure;

        return $this;
    }
}
