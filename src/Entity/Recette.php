<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Le nom de la recette ne peut pas être vide.')]
    #[Assert\Length(max: 100, maxMessage: 'Le nom de la recette ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $nomRecette = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descRecette = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(message: 'Le temps de préparation ne peut pas être vide.')]
    #[Assert\PositiveOrZero(message: 'Le temps de préparation doit être un nombre positif ou zéro.')]
    private ?\DateTimeInterface $tpsPrepa = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Assert\PositiveOrZero(message: 'Le temps de cuisson doit être un nombre positif ou zéro.')]
    private ?\DateTimeInterface $tpsCuisson = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    #[Assert\PositiveOrZero(message: 'Le temps de repos doit être un nombre positif ou zéro.')]
    private ?\DateTimeInterface $tpsRepos = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datePubli = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: 'La sous-catégorie de recette ne peut pas être nulle.')]
    private ?SousCategorieRecette $sousCategorieRecette = null;

    #[ORM\ManyToMany(targetEntity: Ustensile::class, inversedBy: 'recettes')]
    private Collection $ustensiles;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Etape::class, orphanRemoval: true)]
    private Collection $etapes;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: ImageRecette::class, orphanRemoval: true)]
    private Collection $imageRecettes;

    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'recettes')]
    private Collection $sections;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Contenir::class, orphanRemoval: true)]
    private Collection $contenirs;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Noter::class, orphanRemoval: true)]
    private Collection $noters;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Commenter::class, orphanRemoval: true)]
    private Collection $commenters;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userCreator = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'recettesCoupsCoeur')]
    private Collection $users;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $affiche;

    #[ORM\Column]
    private ?int $nbPers = null;

    #[ORM\Column]
    private ?int $difficulte = null;

    public function __construct()
    {
        $this->ustensiles = new ArrayCollection();
        $this->etapes = new ArrayCollection();
        $this->imageRecettes = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->contenirs = new ArrayCollection();
        $this->noters = new ArrayCollection();
        $this->commenters = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRecette(): ?string
    {
        return $this->nomRecette;
    }

    public function setNomRecette(string $nomRecette): static
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    public function getDescRecette(): ?string
    {
        return $this->descRecette;
    }

    public function setDescRecette(?string $descRecette): static
    {
        $this->descRecette = $descRecette;

        return $this;
    }

    public function getTpsPrepa(): ?\DateTimeInterface
    {
        return $this->tpsPrepa;
    }

    public function setTpsPrepa(\DateTimeInterface $tpsPrepa): static
    {
        $this->tpsPrepa = $tpsPrepa;

        return $this;
    }

    public function getTpsCuisson(): ?\DateTimeInterface
    {
        return $this->tpsCuisson;
    }

    public function setTpsCuisson(?\DateTimeInterface $tpsCuisson): static
    {
        $this->tpsCuisson = $tpsCuisson;

        return $this;
    }

    public function getTpsRepos(): ?\DateTimeInterface
    {
        return $this->tpsRepos;
    }

    public function setTpsRepos(?\DateTimeInterface $tpsRepos): static
    {
        $this->tpsRepos = $tpsRepos;

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

    public function getSousCategorieRecette(): ?SousCategorieRecette
    {
        return $this->sousCategorieRecette;
    }

    public function setSousCategorieRecette(?SousCategorieRecette $sousCategorieRecette): static
    {
        $this->sousCategorieRecette = $sousCategorieRecette;

        return $this;
    }

    /**
     * @return Collection<int, Ustensile>
     */
    public function getUstensiles(): Collection
    {
        return $this->ustensiles;
    }

    public function addUstensile(Ustensile $ustensile): static
    {
        if (!$this->ustensiles->contains($ustensile)) {
            $this->ustensiles->add($ustensile);
        }

        return $this;
    }

    public function removeUstensile(Ustensile $ustensile): static
    {
        $this->ustensiles->removeElement($ustensile);

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): static
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ImageRecette>
     */
    public function getImageRecettes(): Collection
    {
        return $this->imageRecettes;
    }

    public function addImageRecette(ImageRecette $imageRecette): static
    {
        if (!$this->imageRecettes->contains($imageRecette)) {
            $this->imageRecettes->add($imageRecette);
            $imageRecette->setRecette($this);
        }

        return $this;
    }

    public function removeImageRecette(ImageRecette $imageRecette): static
    {
        if ($this->imageRecettes->removeElement($imageRecette)) {
            // set the owning side to null (unless already changed)
            if ($imageRecette->getRecette() === $this) {
                $imageRecette->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        $this->sections->removeElement($section);

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
            $contenir->setRecette($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): static
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getRecette() === $this) {
                $contenir->setRecette(null);
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
            $noter->setRecette($this);
        }

        return $this;
    }

    public function removeNoter(Noter $noter): static
    {
        if ($this->noters->removeElement($noter)) {
            // set the owning side to null (unless already changed)
            if ($noter->getRecette() === $this) {
                $noter->setRecette(null);
            }
        }

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
            $commenter->setRecette($this);
        }

        return $this;
    }

    public function removeCommenter(Commenter $commenter): static
    {
        if ($this->commenters->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getRecette() === $this) {
                $commenter->setRecette(null);
            }
        }

        return $this;
    }

    public function getUserCreator(): ?User
    {
        return $this->userCreator;
    }

    public function setUserCreator(?User $userCreator): static
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRecettesCoupsCoeur($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeRecettesCoupsCoeur($this);
        }

        return $this;
    }

    public function getAffiche()
    {
        return $this->affiche;
    }

    public function setAffiche($affiche): static
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getNbPers(): ?int
    {
        return $this->nbPers;
    }

    public function setNbPers(int $nbPers): static
    {
        $this->nbPers = $nbPers;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): static
    {
        $this->difficulte = $difficulte;

        return $this;
    }
}
