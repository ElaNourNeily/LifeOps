<?php

namespace App\Entity;

use App\Repository\TaskSpaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskSpaceRepository::class)]
class TaskSpace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column]
    private ?int $sprintDuration = 14;

    #[ORM\Column(length: 50)]
    private ?string $status = 'Active'; // Active | Archived

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'taskSpaces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null; // Creator / Owner

    #[ORM\OneToMany(mappedBy: 'taskSpace', targetEntity: Tache::class, orphanRemoval: true)]
    private Collection $taches;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class)]
    #[ORM\JoinTable(name: 'task_space_members')]
    private Collection $members; // Team Members

    public function __construct()
    {
        $this->taches = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getSprintDuration(): ?int
    {
        return $this->sprintDuration;
    }

    public function setSprintDuration(int $sprintDuration): static
    {
        $this->sprintDuration = $sprintDuration;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTache(Tache $tache): static
    {
        if (!$this->taches->contains($tache)) {
            $this->taches->add($tache);
            $tache->setTaskSpace($this);
        }
        return $this;
    }

    public function removeTache(Tache $tache): static
    {
        if ($this->taches->removeElement($tache)) {
            if ($tache->getTaskSpace() === $this) {
                $tache->setTaskSpace(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Utilisateur $member): static
    {
        if (!$this->members->contains($member)) {
            $this->members->add($member);
        }
        return $this;
    }

    public function removeMember(Utilisateur $member): static
    {
        $this->members->removeElement($member);
        return $this;
    }
}