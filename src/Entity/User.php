<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $nomPers = null;

    #[ORM\Column(length: 100)]
    private ?string $pnomPers = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNais = null;

    #[ORM\Column(length: 100)]
    private ?string $emailPers = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telPers = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $cpPers = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $adrPers = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $villePers = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $avatar;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descPers = null;

    #[ORM\OneToMany(mappedBy: 'userCreator', targetEntity: Recette::class, orphanRemoval: true)]
    private Collection $recettes;

    #[ORM\ManyToMany(targetEntity: Recette::class, inversedBy: 'users')]
    private Collection $recettesCoupsCoeur;

    #[ORM\OneToMany(mappedBy: 'userComm', targetEntity: Commenter::class, orphanRemoval: true)]
    private Collection $commenters;

    #[ORM\OneToMany(mappedBy: 'userStock', targetEntity: Stock::class, orphanRemoval: true)]
    private Collection $stocks;

    #[ORM\OneToMany(mappedBy: 'userNote', targetEntity: Noter::class, orphanRemoval: true)]
    private Collection $noters;

    public function __construct()
    {
        $this->recettes = new ArrayCollection();
        $this->recettesCoupsCoeur = new ArrayCollection();
        $this->commenters = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->noters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomPers(): ?string
    {
        return $this->nomPers;
    }

    public function setNomPers(string $nomPers): static
    {
        $this->nomPers = $nomPers;

        return $this;
    }

    public function getPnomPers(): ?string
    {
        return $this->pnomPers;
    }

    public function setPnomPers(string $pnomPers): static
    {
        $this->pnomPers = $pnomPers;

        return $this;
    }

    public function getDateNais(): ?\DateTimeInterface
    {
        return $this->dateNais;
    }

    public function setDateNais(\DateTimeInterface $dateNais): static
    {
        $this->dateNais = $dateNais;

        return $this;
    }

    public function getEmailPers(): ?string
    {
        return $this->emailPers;
    }

    public function setEmailPers(string $emailPers): static
    {
        $this->emailPers = $emailPers;

        return $this;
    }

    public function getTelPers(): ?string
    {
        return $this->telPers;
    }

    public function setTelPers(?string $telPers): static
    {
        $this->telPers = $telPers;

        return $this;
    }

    public function getCpPers(): ?string
    {
        return $this->cpPers;
    }

    public function setCpPers(?string $cpPers): static
    {
        $this->cpPers = $cpPers;

        return $this;
    }

    public function getAdrPers(): ?string
    {
        return $this->adrPers;
    }

    public function setAdrPers(?string $adrPers): static
    {
        $this->adrPers = $adrPers;

        return $this;
    }

    public function getVillePers(): ?string
    {
        return $this->villePers;
    }

    public function setVillePers(?string $villePers): static
    {
        $this->villePers = $villePers;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getDescPers(): ?string
    {
        return $this->descPers;
    }

    public function setDescPers(?string $descPers): static
    {
        $this->descPers = $descPers;

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
            $recette->setUserCreator($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): static
    {
        if ($this->recettes->removeElement($recette)) {
            // set the owning side to null (unless already changed)
            if ($recette->getUserCreator() === $this) {
                $recette->setUserCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recette>
     */
    public function getRecettesCoupsCoeur(): Collection
    {
        return $this->recettesCoupsCoeur;
    }

    public function addRecettesCoupsCoeur(Recette $recettesCoupsCoeur): static
    {
        if (!$this->recettesCoupsCoeur->contains($recettesCoupsCoeur)) {
            $this->recettesCoupsCoeur->add($recettesCoupsCoeur);
        }

        return $this;
    }

    public function removeRecettesCoupsCoeur(Recette $recettesCoupsCoeur): static
    {
        $this->recettesCoupsCoeur->removeElement($recettesCoupsCoeur);

        return $this;
    }

    /**
     * @return Collection<int, Commenter>
     */
    public function getCommenters(): Collection
    {
        return $this->commenters;
    }

    public function addCommenter(Commenter $commenter): static
    {
        if (!$this->commenters->contains($commenter)) {
            $this->commenters->add($commenter);
            $commenter->setUserComm($this);
        }

        return $this;
    }

    public function removeCommenter(Commenter $commenter): static
    {
        if ($this->commenters->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getUserComm() === $this) {
                $commenter->setUserComm(null);
            }
        }

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
            $stock->setUserStock($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getUserStock() === $this) {
                $stock->setUserStock(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Noter>
     */
    public function getNoters(): Collection
    {
        return $this->noters;
    }

    public function addNoter(Noter $noter): static
    {
        if (!$this->noters->contains($noter)) {
            $this->noters->add($noter);
            $noter->setUserNote($this);
        }

        return $this;
    }

    public function removeNoter(Noter $noter): static
    {
        if ($this->noters->removeElement($noter)) {
            // set the owning side to null (unless already changed)
            if ($noter->getUserNote() === $this) {
                $noter->setUserNote(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getUsername();
    }
}
