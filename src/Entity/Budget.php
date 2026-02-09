<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BudgetRepository::class)]
class Budget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotNull(message: 'Le revenu mensuel est obligatoire')]
    #[Assert\Positive(message: 'Le revenu mensuel ne peut pas être négatif ou zéro')]
    #[Assert\Type(type: 'float', message: 'Le revenu mensuel doit être un nombre')]
    private ?float $revenu_mensuel = null;

    #[ORM\Column]
    #[Assert\NotNull(message: 'Le plafond est obligatoire')]
    #[Assert\Positive(message: 'Le plafond ne peut pas être négatif ou zéro')]
    #[Assert\Type(type: 'float', message: 'Le plafond doit être un nombre')]
    private ?float $plafond = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull(message: 'Le mois est obligatoire')]
    #[Assert\NotBlank(message: 'Le mois ne peut pas être vide')]
    #[Assert\Length(min: 7, max: 7, exactMessage: 'Le mois doit être au format YYYY-MM (ex: 2026-02)')]
    #[Assert\Regex(pattern: '/^\d{4}-\d{2}$/', message: 'Le mois doit être au format YYYY-MM')]
    private ?string $mois = null;

    #[ORM\Column]
    #[Assert\NotNull(message: 'Les économies sont obligatoires')]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'Les économies ne peuvent pas être négatives')]
    #[Assert\Type(type: 'float', message: 'Les économies doivent être un nombre')]
    private ?float $economies = null;

    #[ORM\ManyToOne(inversedBy: 'budgets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'budget', targetEntity: Depense::class)]
    private Collection $depenses;

    public function __construct()
    {
        $this->depenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRevenuMensuel(): ?float
    {
        return $this->revenu_mensuel;
    }

    public function setRevenuMensuel(float $revenu_mensuel): static
    {
        $this->revenu_mensuel = $revenu_mensuel;

        return $this;
    }

    public function getPlafond(): ?float
    {
        return $this->plafond;
    }

    public function setPlafond(float $plafond): static
    {
        $this->plafond = $plafond;

        return $this;
    }

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): static
    {
        $this->mois = $mois;

        return $this;
    }

    public function getEconomies(): ?float
    {
        return $this->economies;
    }

    public function setEconomies(float $economies): static
    {
        $this->economies = $economies;

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
     * @return Collection<int, Depense>
     */
    public function getDepenses(): Collection
    {
        return $this->depenses;
    }

    public function addDepense(Depense $depense): static
    {
        if (!$this->depenses->contains($depense)) {
            $this->depenses->add($depense);
            $depense->setBudget($this);
        }

        return $this;
    }

    public function removeDepense(Depense $depense): static
    {
        if ($this->depenses->removeElement($depense)) {
            // set the owning side to null (unless already changed)
            if ($depense->getBudget() === $this) {
                $depense->setBudget(null);
            }
        }

        return $this;
    }
}
