<?php

namespace App\Entity;

use App\Repository\CommenterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommenterRepository::class)]
class Commenter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $textComm = null;

    #[ORM\ManyToOne(inversedBy: 'commenters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recette $recette = null;

    #[ORM\ManyToOne(inversedBy: 'commenters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userComm = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePubli = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextComm(): ?string
    {
        return $this->textComm;
    }

    public function setTextComm(string $textComm): static
    {
        $this->textComm = $textComm;

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

    public function getUserComm(): ?User
    {
        return $this->userComm;
    }

    public function setUserComm(?User $userComm): static
    {
        $this->userComm = $userComm;

        return $this;
    }

    public function getDatePubli(): ?\DateTimeInterface
    {
        return $this->datePubli;
    }

    public function setDatePubli(\DateTimeInterface $datePubli): static
    {
        $this->datePubli = $datePubli;

        return $this;
    }
}
