<?php

namespace App\Entity;

use App\Repository\BilanSanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BilanSanteRepository::class)]
class BilanSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'La date de début est obligatoire.')]
    #[Assert\LessThanOrEqual('today', message: 'La date de début ne peut pas être dans le futur.')]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'La date de fin est obligatoire.')]
    #[Assert\LessThanOrEqual('today', message: 'La date de fin ne peut pas être dans le futur.')]
    #[Assert\GreaterThanOrEqual(propertyPath: 'date_debut', message: 'La date de fin doit être après la date de début.')]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le niveau de fatigue est obligatoire.')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'Le niveau de fatigue doit être entre {{ min }} et {{ max }}.'
    )]
    private ?int $niveau_fatigue = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le niveau de stress est obligatoire.')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'Le niveau de stress doit être entre {{ min }} et {{ max }}.'
    )]
    private ?int $niveau_stress = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le score de forme est obligatoire.')]
    #[Assert\Range(
        min: 1,
        max: 10,
        notInRangeMessage: 'Le score de forme doit être entre {{ min }} et {{ max }}.'
    )]
    #[Assert\Type(type: 'float', message: 'Le score de forme doit être un nombre.')]
    private ?float $score_forme = null;

    #[ORM\Column]
    private ?bool $risque_burnout = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(
        max: 2000,
        maxMessage: 'Les recommandations ne peuvent pas dépasser {{ limit }} caractères.'
    )]
    private ?string $recommandations = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $analyse_ia = null;

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

    public function getAnalyseIa(): ?array
    {
        return $this->analyse_ia;
    }

    public function setAnalyseIa(?array $analyse_ia): static
    {
        $this->analyse_ia = $analyse_ia;

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
