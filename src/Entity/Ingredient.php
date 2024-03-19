<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomIng = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $imgIng;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UniteMesure $uniteMesure = null;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Allergene $allergene = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: Contenir::class, orphanRemoval: true)]
    private Collection $contenirs;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousFamilleIngredient $sousFamilleIngredient = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: Stock::class, orphanRemoval: true)]
    private Collection $stocks;

    public function __construct()
    {
        $this->contenirs = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomIng(): ?string
    {
        return $this->nomIng;
    }

    public function setNomIng(string $nomIng): static
    {
        $this->nomIng = $nomIng;

        return $this;
    }

    public function getImgIng()
    {
        return $this->imgIng;
    }

    public function setImgIng($imgIng): static
    {
        $this->imgIng = $imgIng;

        return $this;
    }

    public function getUniteMesure(): ?UniteMesure
    {
        return $this->uniteMesure;
    }

    public function setUniteMesure(?UniteMesure $uniteMesure): static
    {
        $this->uniteMesure = $uniteMesure;

        return $this;
    }

    public function getAllergene(): ?Allergene
    {
        return $this->allergene;
    }

    public function setAllergene(?Allergene $allergene): static
    {
        $this->allergene = $allergene;

        return $this;
    }

    /**
     * @return Collection<int, Contenir>
     */
    public function getContenirs(): Collection
    {
        return $this->contenirs;
    }

    public function addContenir(Contenir $contenir): static
    {
        if (!$this->contenirs->contains($contenir)) {
            $this->contenirs->add($contenir);
            $contenir->setIngredient($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getIngredient() === $this) {
                $contenir->setIngredient(null);
            }
        }

        return $this;
    }

    public function getSousFamilleIngredient(): ?SousFamilleIngredient
    {
        return $this->sousFamilleIngredient;
    }

    public function setSousFamilleIngredient(?SousFamilleIngredient $sousFamilleIngredient): static
    {
        $this->sousFamilleIngredient = $sousFamilleIngredient;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setIngredient($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getIngredient() === $this) {
                $stock->setIngredient(null);
            }
        }

        return $this;
    }
}
