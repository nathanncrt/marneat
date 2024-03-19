<?php

namespace App\Entity;

use App\Repository\UniteMesureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteMesureRepository::class)]
class UniteMesure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $codeUm = null;

    #[ORM\Column(length: 100)]
    private ?string $libUm = null;

    #[ORM\OneToMany(mappedBy: 'uniteMesure', targetEntity: Ingredient::class, orphanRemoval: true)]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeUm(): ?string
    {
        return $this->codeUm;
    }

    public function setCodeUm(string $codeUm): static
    {
        $this->codeUm = $codeUm;

        return $this;
    }

    public function getLibUm(): ?string
    {
        return $this->libUm;
    }

    public function setLibUm(string $libUm): static
    {
        $this->libUm = $libUm;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setUniteMesure($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getUniteMesure() === $this) {
                $ingredient->setUniteMesure(null);
            }
        }

        return $this;
    }
}
