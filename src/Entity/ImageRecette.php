<?php

namespace App\Entity;

use App\Repository\ImageRecetteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRecetteRepository::class)]
class ImageRecette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $jpeg;

    #[ORM\ManyToOne(inversedBy: 'imageRecettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recette $recette = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJpeg()
    {
        return $this->jpeg;
    }

    public function setJpeg($jpeg): static
    {
        $this->jpeg = $jpeg;

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
}
