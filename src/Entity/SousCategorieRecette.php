<?php

namespace App\Entity;

use App\Repository\SousCategorieRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategorieRecetteRepository::class)]
class SousCategorieRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libSousCategorieRecette = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategorieRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieRecette $categorieRecette = null;

    #[ORM\OneToMany(mappedBy: 'sousCategorieRecette', targetEntity: Recette::class, orphanRemoval: true)]
    private Collection $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSousCategorieRecette(): ?string
    {
        return $this->libSousCategorieRecette;
    }

    public function setLibSousCategorieRecette(string $libSousCategorieRecette): static
    {
        $this->libSousCategorieRecette = $libSousCategorieRecette;

        return $this;
    }

    public function getCategorieRecette(): ?CategorieRecette
    {
        return $this->categorieRecette;
    }

    public function setCategorieRecette(?CategorieRecette $categorieRecette): static
    {
        $this->categorieRecette = $categorieRecette;

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): static
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes->add($recette);
            $recette->setSousCategorieRecette($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getSousCategorieRecette() === $this) {
                $recette->setSousCategorieRecette(null);
            }
        }

        return $this;
    }
}
