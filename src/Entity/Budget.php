<?php

namespace App\Entity;

use App\Repository\BudgetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BudgetRepository::class)]
class Budget
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $revenu_mensuel = null;

    #[ORM\Column]
    private ?float $plafond = null;

    #[ORM\Column(length: 255)]
    private ?string $mois = null;

    #[ORM\Column]
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
