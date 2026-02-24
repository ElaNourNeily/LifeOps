<?php

namespace App\Entity;

use App\Repository\SuiviSanteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiviSanteRepository::class)]
class SuiviSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $heuresSommeil = null;

    #[ORM\Column]
    private ?int $qualiteSommeil = null;

    #[ORM\Column]
    private ?int $verresEau = null;

    #[ORM\Column]
    private ?int $minutesActivite = null;

    #[ORM\Column(nullable: true)]
    private ?float $poids = null;

    #[ORM\Column]
    private ?int $humeur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 255, nullable: true)]
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
