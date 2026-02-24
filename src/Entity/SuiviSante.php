<?php

namespace App\Entity;

use App\Repository\SuiviSanteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SuiviSanteRepository::class)]
class SuiviSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'La date est obligatoire.')]
    #[Assert\LessThanOrEqual('today', message: 'La date ne peut pas être dans le futur.')]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Les heures de sommeil sont obligatoires.')]
    #[Assert\Range(
        min: 0,
        max: 24,
        notInRangeMessage: 'Les heures de sommeil doivent être entre {{ min }} et {{ max }} heures.'
    )]
    #[Assert\Type(type: 'float', message: 'Les heures de sommeil doivent être un nombre.')]
    private ?float $heuresSommeil = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'La qualité du sommeil est obligatoire.')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'La qualité du sommeil doit être entre {{ min }} et {{ max }}.'
    )]
    private ?int $qualiteSommeil = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le nombre de verres d\'eau est obligatoire.')]
    #[Assert\Range(
        min: 0, 
        max: 30, 
        notInRangeMessage: 'Le nombre de verres d\'eau doit être compris entre {{ min }} et {{ max }}.'
    )]
    #[Assert\Type(type: 'integer', message: 'Le nombre de verres doit être un entier.')]
    private ?int $verresEau = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Les minutes d\'activité sont obligatoires.')]
    #[Assert\Range(
        min: 0, 
        max: 1440, 
        notInRangeMessage: 'La durée doit être comprise entre {{ min }} et {{ max }} minutes (24h max).'
    )]
    #[Assert\Type(type: 'integer', message: 'Les minutes d\'activité doivent être un entier.')]
    private ?int $minutesActivite = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive(message: 'Le poids doit être un nombre positif.')]
    #[Assert\Range(
        min: 20,
        max: 300,
        notInRangeMessage: 'Le poids doit être entre {{ min }} et {{ max }} kg.'
    )]
    #[Assert\Type(type: 'float', message: 'Le poids doit être un nombre.')]
    private ?float $poids = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'L\'humeur est obligatoire.')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'L\'humeur doit être entre {{ min }} et {{ max }}.'
    )]
    private ?int $humeur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        max: 1000,
        maxMessage: 'Les notes ne peuvent pas dépasser {{ limit }} caractères.'
    )]
    private ?string $notes = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(
        max: 255,
        maxMessage: 'Le type d\'activité ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $activite = null;

    #[ORM\ManyToOne(inversedBy: 'suiviSantes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'suiviSantes')]
    private ?BilanSante $bilanSante = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHeuresSommeil(): ?float
    {
        return $this->heuresSommeil;
    }

    public function setHeuresSommeil(float $heuresSommeil): static
    {
        $this->heuresSommeil = $heuresSommeil;

        return $this;
    }

    public function getQualiteSommeil(): ?int
    {
        return $this->qualiteSommeil;
    }

    public function setQualiteSommeil(int $qualiteSommeil): static
    {
        $this->qualiteSommeil = $qualiteSommeil;

        return $this;
    }

    public function getVerresEau(): ?int
    {
        return $this->verresEau;
    }

    public function setVerresEau(int $verresEau): static
    {
        $this->verresEau = $verresEau;

        return $this;
    }

    public function getMinutesActivite(): ?int
    {
        return $this->minutesActivite;
    }

    public function setMinutesActivite(int $minutesActivite): static
    {
        $this->minutesActivite = $minutesActivite;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(?float $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getHumeur(): ?int
    {
        return $this->humeur;
    }

    public function setHumeur(int $humeur): static
    {
        $this->humeur = $humeur;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(?string $activite): static
    {
        $this->activite = $activite;

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

    public function getBilanSante(): ?BilanSante
    {
        return $this->bilanSante;
    }

    public function setBilanSante(?BilanSante $bilanSante): static
    {
        $this->bilanSante = $bilanSante;

        return $this;
    }
}
