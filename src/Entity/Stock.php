<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $qteDispo = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ingredient $ingredient = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userStock = null;

    #[ORM\Column(length: 255)]
    private ?string $uniteMesure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQteDispo(): ?float
    {
        return $this->qteDispo;
    }

    public function setQteDispo(float $qteDispo): static
    {
        $this->qteDispo = $qteDispo;

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

    public function getUserStock(): ?User
    {
        return $this->userStock;
    }

    public function setUserStock(?User $userStock): static
    {
        $this->userStock = $userStock;

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
