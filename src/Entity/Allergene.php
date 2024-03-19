<?php

namespace App\Entity;

use App\Repository\AllergeneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergeneRepository::class)]
class Allergene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libAll = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descAll = null;

    #[ORM\OneToMany(mappedBy: 'allergene', targetEntity: Ingredient::class, orphanRemoval: true)]
    private Collection $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibAll(): ?string
    {
        return $this->libAll;
    }

    public function setLibAll(string $libAll): static
    {
        $this->libAll = $libAll;

        return $this;
    }

    public function getDescAll(): ?string
    {
        return $this->descAll;
    }

    public function setDescAll(?string $descAll): static
    {
        $this->descAll = $descAll;

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
            $ingredient->setAllergene($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getAllergene() === $this) {
                $ingredient->setAllergene(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getLibAll();
    }
}
