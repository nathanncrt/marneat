<?php

namespace App\Entity;

use App\Repository\UstensileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UstensileRepository::class)]
class Ustensile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomUs = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imgUs;

    #[ORM\ManyToMany(targetEntity: Recette::class, mappedBy: 'ustensiles')]
    private Collection $recettes;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUs(): ?string
    {
        return $this->nomUs;
    }

    public function setNomUs(string $nomUs): static
    {
        $this->nomUs = $nomUs;

        return $this;
    }

    public function getImgUs()
    {
        return $this->imgUs;
    }

    public function setImgUs($imgUs): static
    {
        $this->imgUs = $imgUs;

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
            $recette->addUstensile($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            $recette->removeUstensile($this);
        }

        return $this;
    }
}
