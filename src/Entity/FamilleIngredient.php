<?php

namespace App\Entity;

use App\Repository\FamilleIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilleIngredientRepository::class)]
class FamilleIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libFamIng = null;

    #[ORM\OneToMany(mappedBy: 'familleIngredient', targetEntity: SousFamilleIngredient::class, orphanRemoval: true)]
    private Collection $sousFamilleIngredients;

    public function __construct()
    {
        $this->sousFamilleIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibFamIng(): ?string
    {
        return $this->libFamIng;
    }

    public function setLibFamIng(string $libFamIng): static
    {
        $this->libFamIng = $libFamIng;

        return $this;
    }

    /**
     * @return Collection<int, SousFamilleIngredient>
     */
    public function getSousFamilleIngredients(): Collection
    {
        return $this->sousFamilleIngredients;
    }

    public function addSousFamilleIngredient(SousFamilleIngredient $sousFamilleIngredient): static
    {
        if (!$this->sousFamilleIngredients->contains($sousFamilleIngredient)) {
            $this->sousFamilleIngredients->add($sousFamilleIngredient);
            $sousFamilleIngredient->setFamilleIngredient($this);
        }

        return $this;
    }

    public function removeSousFamilleIngredient(SousFamilleIngredient $sousFamilleIngredient): static
    {
        if ($this->sousFamilleIngredients->removeElement($sousFamilleIngredient)) {
            // set the owning side to null (unless already changed)
            if ($sousFamilleIngredient->getFamilleIngredient() === $this) {
                $sousFamilleIngredient->setFamilleIngredient(null);
            }
        }

        return $this;
    }
}
