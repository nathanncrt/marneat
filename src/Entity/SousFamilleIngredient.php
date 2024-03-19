<?php

namespace App\Entity;

use App\Repository\SousFamilleIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousFamilleIngredientRepository::class)]
class SousFamilleIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libSousFamImg = null;

    #[ORM\OneToMany(mappedBy: 'sousFamilleIngredient', targetEntity: Ingredient::class, orphanRemoval: true)]
    private Collection $ingredients;

    #[ORM\ManyToOne(inversedBy: 'sousFamilleIngredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FamilleIngredient $familleIngredient = null;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSousFamImg(): ?string
    {
        return $this->libSousFamImg;
    }

    public function setLibSousFamImg(string $libSousFamImg): static
    {
        $this->libSousFamImg = $libSousFamImg;

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
            $ingredient->setSousFamilleIngredient($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getSousFamilleIngredient() === $this) {
                $ingredient->setSousFamilleIngredient(null);
            }
        }

        return $this;
    }

    public function getFamilleIngredient(): ?FamilleIngredient
    {
        return $this->familleIngredient;
    }

    public function setFamilleIngredient(?FamilleIngredient $familleIngredient): static
    {
        $this->familleIngredient = $familleIngredient;

        return $this;
    }
}
