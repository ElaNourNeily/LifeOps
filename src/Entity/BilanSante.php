<?php

namespace App\Entity;

use App\Repository\BilanSanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilanSanteRepository::class)]
class BilanSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    private ?int $niveau_fatigue = null;

    #[ORM\Column]
    private ?int $niveau_stress = null;

    #[ORM\Column]
    private ?float $score_forme = null;

    #[ORM\Column]
    private ?bool $risque_burnout = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recommandations = null;

    #[ORM\ManyToOne(inversedBy: 'bilanSantes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'bilanSante', targetEntity: SuiviSante::class)]
    private Collection $suiviSantes;

    public function __construct()
    {
        $this->suiviSantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getNiveauFatigue(): ?int
    {
        return $this->niveau_fatigue;
    }

    public function setNiveauFatigue(int $niveau_fatigue): static
    {
        $this->niveau_fatigue = $niveau_fatigue;

        return $this;
    }

    public function getNiveauStress(): ?int
    {
        return $this->niveau_stress;
    }

    public function setNiveauStress(int $niveau_stress): static
    {
        $this->niveau_stress = $niveau_stress;

        return $this;
    }

    public function getScoreForme(): ?float
    {
        return $this->score_forme;
    }

    public function setScoreForme(float $score_forme): static
    {
        $this->score_forme = $score_forme;

        return $this;
    }

    public function isRisqueBurnout(): ?bool
    {
        return $this->risque_burnout;
    }

    public function setRisqueBurnout(bool $risque_burnout): static
    {
        $this->risque_burnout = $risque_burnout;

        return $this;
    }

    public function getRecommandations(): ?string
    {
        return $this->recommandations;
    }

    public function setRecommandations(string $recommandations): static
    {
        $this->recommandations = $recommandations;

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
     * @return Collection<int, SuiviSante>
     */
    public function getSuiviSantes(): Collection
    {
        return $this->suiviSantes;
    }

    public function addSuiviSante(SuiviSante $suiviSante): static
    {
        if (!$this->suiviSantes->contains($suiviSante)) {
            $this->suiviSantes->add($suiviSante);
            $suiviSante->setBilanSante($this);
        }

        return $this;
    }

    public function removeSuiviSante(SuiviSante $suiviSante): static
    {
        if ($this->suiviSantes->removeElement($suiviSante)) {
            // set the owning side to null (unless already changed)
            if ($suiviSante->getBilanSante() === $this) {
                $suiviSante->setBilanSante(null);
            }
        }

        return $this;
    }
}
