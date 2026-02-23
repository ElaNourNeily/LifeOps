<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $duree = null; // in minutes presumably

    #[ORM\Column]
    private ?int $priorite = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut_estimee = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin_estimee = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau_urgence = null;

    #[ORM\ManyToOne(inversedBy: 'activites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Planning $planning = null;

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

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getHeureDebutEstimee(): ?\DateTimeInterface
    {
        return $this->heure_debut_estimee;
    }

    public function setHeureDebutEstimee(\DateTimeInterface $heure_debut_estimee): static
    {
        $this->heure_debut_estimee = $heure_debut_estimee;

        return $this;
    }

    public function getHeureFinEstimee(): ?\DateTimeInterface
    {
        return $this->heure_fin_estimee;
    }

    public function setHeureFinEstimee(\DateTimeInterface $heure_fin_estimee): static
    {
        $this->heure_fin_estimee = $heure_fin_estimee;

        return $this;
    }

    public function getNiveauUrgence(): ?string
    {
        return $this->niveau_urgence;
    }

    public function setNiveauUrgence(string $niveau_urgence): static
    {
        $this->niveau_urgence = $niveau_urgence;

        return $this;
    }

    public function getPlanning(): ?Planning
    {
        return $this->planning;
    }

    public function setPlanning(?Planning $planning): static
    {
        $this->planning = $planning;

        return $this;
    }
}
