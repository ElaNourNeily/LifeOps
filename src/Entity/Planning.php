<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload): void
    {
        if ($this->heure_debut_journee && $this->heure_fin_journee) {
            if ($this->heure_fin_journee <= $this->heure_debut_journee) {
                $context->buildViolation("L'heure de fin doit être après l'heure de début.")
                    ->atPath('heure_fin_journee')
                    ->addViolation();
            }
        }
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?bool $disponibilite = true;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotNull(message: "L'heure de début est obligatoire.")]
    private ?\DateTimeInterface $heure_debut_journee = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotNull(message: "L'heure de fin est obligatoire.")]
    private ?\DateTimeInterface $heure_fin_journee = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(mappedBy: 'planning', targetEntity: Activite::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $activites;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function isDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getHeureDebutJournee(): ?\DateTimeInterface
    {
        return $this->heure_debut_journee;
    }

    public function setHeureDebutJournee(?\DateTimeInterface $heure_debut_journee): static
    {
        $this->heure_debut_journee = $heure_debut_journee;

        return $this;
    }

    public function getHeureFinJournee(): ?\DateTimeInterface
    {
        return $this->heure_fin_journee;
    }

    public function setHeureFinJournee(?\DateTimeInterface $heure_fin_journee): static
    {
        $this->heure_fin_journee = $heure_fin_journee;

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
     * @return Collection<int, Activite>
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites->add($activite);
            $activite->setPlanning($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getPlanning() === $this) {
                $activite->setPlanning(null);
            }
        }

        return $this;
    }
}
<<<<<<< HEAD
=======

>>>>>>> ebaffe1c (first commit)
