<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre est obligatoire.")]
    #[Assert\Length(min: 3, max: 255, minMessage: "Le titre doit faire au moins {{ limit }} caractères.")]
    private ?string $titre = null;

    #[ORM\Column]
    #[Assert\Positive(message: "La durée doit être positive.")]
    private ?int $duree = null; // in minutes presumably

    #[ORM\Column]
    private ?int $priorite = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = 'en_attente';

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(message: "L'heure de début est obligatoire.")]
    private ?\DateTimeInterface $heure_debut_estimee = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(message: "L'heure de fin est obligatoire.")]
    #[Assert\GreaterThan(propertyPath: "heure_debut_estimee", message: "L'heure de fin doit être après l'heure de début.")]
    private ?\DateTimeInterface $heure_fin_estimee = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau_urgence = 'moyen';

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\NotBlank(message: "La catégorie est obligatoire.")]
    private ?string $categorie = null;

    #[ORM\Column(length: 7, nullable: true)] // Hex color code e.g. #FFFFFF
    #[Assert\NotBlank(message: "La couleur est obligatoire.")]
    private ?string $couleur = null;

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

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPriorite(): ?int
    {
        return $this->priorite;
    }

    public function setPriorite(?int $priorite): static
    {
        $this->priorite = $priorite;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getHeureDebutEstimee(): ?\DateTimeInterface
    {
        return $this->heure_debut_estimee;
    }

    public function setHeureDebutEstimee(?\DateTimeInterface $heure_debut_estimee): static
    {
        $this->heure_debut_estimee = $heure_debut_estimee;

        return $this;
    }

    public function getHeureFinEstimee(): ?\DateTimeInterface
    {
        return $this->heure_fin_estimee;
    }

    public function setHeureFinEstimee(?\DateTimeInterface $heure_fin_estimee): static
    {
        $this->heure_fin_estimee = $heure_fin_estimee;

        return $this;
    }

    public function getNiveauUrgence(): ?string
    {
        return $this->niveau_urgence;
    }

    public function setNiveauUrgence(?string $niveau_urgence): static
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }
}
