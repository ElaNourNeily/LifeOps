<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = 'ToDo'; // ToDo | InProgress | Review | Done

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $priorite = 1;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $difficulte = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $estimatedTime = null;

    #[ORM\Column(type: Types::FLOAT, nullable: true)]
    private ?float $realTimeSpent = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $deadline = null;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null; // Owner (Solo)

    #[ORM\ManyToOne(targetEntity: TaskSpace::class, inversedBy: 'taches')]
    #[ORM\JoinColumn(nullable: true)]
    private ?TaskSpace $taskSpace = null; // Project (Team)

    #[ORM\ManyToOne(targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Utilisateur $assignedTo = null; // Assignee (Group Member)

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->statut = 'ToDo';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getPriorite(): ?int
    {
        return $this->priorite;
    }

    public function setPriorite(int $priorite): static
    {
        $this->priorite = $priorite;
        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(?int $difficulte): static
    {
        $this->difficulte = $difficulte;
        return $this;
    }

    public function getEstimatedTime(): ?float
    {
        return $this->estimatedTime;
    }

    public function setEstimatedTime(?float $estimatedTime): static
    {
        $this->estimatedTime = $estimatedTime;
        return $this;
    }

    public function getRealTimeSpent(): ?float
    {
        return $this->realTimeSpent;
    }

    public function setRealTimeSpent(?float $realTimeSpent): static
    {
        $this->realTimeSpent = $realTimeSpent;
        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(?\DateTimeInterface $deadline): static
    {
        $this->deadline = $deadline;
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

    public function getTaskSpace(): ?TaskSpace
    {
        return $this->taskSpace;
    }

    public function setTaskSpace(?TaskSpace $taskSpace): static
    {
        $this->taskSpace = $taskSpace;
        return $this;
    }

    public function getAssignedTo(): ?Utilisateur
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(?Utilisateur $assignedTo): static
    {
        $this->assignedTo = $assignedTo;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}