<?php

namespace App\Entity;

use App\Repository\CategorieRecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRecetteRepository::class)]
class CategorieRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libCatRecette = null;

    #[ORM\OneToMany(mappedBy: 'categorieRecette', targetEntity: SousCategorieRecette::class, orphanRemoval: true)]
    private Collection $sousCategorieRecettes;

    public function __construct()
    {
        $this->sousCategorieRecettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibCatRecette(): ?string
    {
        return $this->libCatRecette;
    }

    public function setLibCatRecette(string $libCatRecette): static
    {
        $this->libCatRecette = $libCatRecette;

        return $this;
    }

    /**
     * @return Collection<int, SousCategorieRecette>
     */
    public function getSousCategorieRecettes(): Collection
    {
        return $this->sousCategorieRecettes;
    }

    public function addSousCategorieRecette(SousCategorieRecette $sousCategorieRecette): static
    {
        if (!$this->sousCategorieRecettes->contains($sousCategorieRecette)) {
            $this->sousCategorieRecettes->add($sousCategorieRecette);
            $sousCategorieRecette->setCategorieRecette($this);
        }

        return $this;
    }

    public function removeSousCategorieRecette(SousCategorieRecette $sousCategorieRecette): static
    {
        if ($this->sousCategorieRecettes->removeElement($sousCategorieRecette)) {
            // set the owning side to null (unless already changed)
            if ($sousCategorieRecette->getCategorieRecette() === $this) {
                $sousCategorieRecette->setCategorieRecette(null);
            }
        }

        return $this;
    }
}
