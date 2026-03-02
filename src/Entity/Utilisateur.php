<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Enum\UserRole;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un compte existe déjà avec cette adresse email.')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $mot_de_passe = null;

    #[ORM\Column(length: 50)]
    private ?string $role = 'ROLE_USER';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $empreinte_faciale = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ban_until = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;
    
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    #[Assert\Range(min: 0, max: 120, notInRangeMessage: "L'âge doit être compris entre {{ min }} et {{ max }} ans.")]
    private ?int $age = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Feedback::class, orphanRemoval: true)]
    private Collection $feedbacks;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: BilanSante::class, orphanRemoval: true)]
    private Collection $bilanSantes;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: SuiviSante::class, orphanRemoval: true)]
    private Collection $suiviSantes;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Budget::class, orphanRemoval: true)]
    private Collection $budgets;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Depense::class, orphanRemoval: true)]
    private Collection $depenses;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Planning::class, orphanRemoval: true)]
    private Collection $plannings;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: TaskSpace::class, orphanRemoval: true)]
    private Collection $taskSpaces;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Tache::class, orphanRemoval: true)]
    private Collection $taches;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Objectif::class, orphanRemoval: true)]
    private Collection $objectifs;

    #[ORM\Column(type: 'boolean')]
    private bool $isVerified = false;

    #[ORM\Column(length: 6, nullable: true)]
    private ?string $verificationCode = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $verificationCodeExpiresAt = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $googleId = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $facebookId = null;

    #[ORM\Column(length: 255, unique: true, nullable: true)]
    private ?string $githubId = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: 'boolean')]
    private bool $hasSetPassword = true;

    public function __construct()
    {
        $this->feedbacks = new ArrayCollection();
        $this->bilanSantes = new ArrayCollection();
        $this->suiviSantes = new ArrayCollection();
        $this->budgets = new ArrayCollection();
        $this->depenses = new ArrayCollection();
        $this->plannings = new ArrayCollection();
        $this->taskSpaces = new ArrayCollection();
        $this->taches = new ArrayCollection();
        $this->objectifs = new ArrayCollection();
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function hasSetPassword(): bool
    {
        return $this->hasSetPassword;
    }

    public function setHasSetPassword(bool $hasSetPassword): static
    {
        $this->hasSetPassword = $hasSetPassword;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = [];
        $roleEnum = UserRole::fromString($this->role ?? 'ROLE_USER');
        $roles[] = $roleEnum->value;
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        foreach ($roles as $r) {
            $value = is_string($r) ? $r : (method_exists($r, 'value') ? $r->value : null);
            if ($value && $value !== 'ROLE_USER') {
                $this->role = $value;
                return $this;
            }
        }
        $this->role = UserRole::USER->value;
        return $this;
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getRoleEnum(): UserRole
    {
        return UserRole::fromString($this->role ?? UserRole::USER->value);
    }

    public function setRoleEnum(UserRole $role): static
    {
        $this->role = $role->value;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->mot_de_passe;
    }

    public function setPassword(string $password): static
    {
        $this->mot_de_passe = $password;

        return $this;
    }
    
    public function getMotDePasse(): string
    {
        return $this->mot_de_passe;
    }
    
    public function setMotDePasse(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    public function getEmpreinteFaciale(): ?string
    {
        return $this->empreinte_faciale;
    }

    public function setEmpreinteFaciale(?string $empreinte_faciale): static
    {
        $this->empreinte_faciale = $empreinte_faciale;

        return $this;
    }

    public function getBanUntil(): ?\DateTimeInterface
    {
        return $this->ban_until;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->created_at = $createdAt;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function setBanUntil(?\DateTimeInterface $ban_until): static
    {
        $this->ban_until = $ban_until;

        return $this;
    }

    public function isBanned(): bool
    {
        return $this->ban_until !== null && $this->ban_until > new \DateTime();
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getVerificationCode(): ?string
    {
        return $this->verificationCode;
    }

    public function setVerificationCode(?string $verificationCode): static
    {
        $this->verificationCode = $verificationCode;

        return $this;
    }

    public function getVerificationCodeExpiresAt(): ?\DateTimeImmutable
    {
        return $this->verificationCodeExpiresAt;
    }

    public function setVerificationCodeExpiresAt(?\DateTimeImmutable $verificationCodeExpiresAt): static
    {
        $this->verificationCodeExpiresAt = $verificationCodeExpiresAt;

        return $this;
    }

    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    public function setGoogleId(?string $googleId): static
    {
        $this->googleId = $googleId;

        return $this;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): static
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function getGithubId(): ?string
    {
        return $this->githubId;
    }

    public function setGithubId(?string $githubId): static
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return Collection<int, Budget>
     */
    public function getBudgets(): Collection
    {
        return $this->budgets;
    }

    public function addBudget(Budget $budget): static
    {
        if (!$this->budgets->contains($budget)) {
            $this->budgets->add($budget);
            $budget->setUtilisateur($this);
        }

        return $this;
    }

    public function removeBudget(Budget $budget): static
    {
        if ($this->budgets->removeElement($budget)) {
            if ($budget->getUtilisateur() === $this) {
                $budget->setUtilisateur(null);
            }
        }

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
            $depense->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDepense(Depense $depense): static
    {
        if ($this->depenses->removeElement($depense)) {
            if ($depense->getUtilisateur() === $this) {
                $depense->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedbacks(): Collection
    {
        return $this->feedbacks;
    }

    public function addFeedback(Feedback $feedback): static
    {
        if (!$this->feedbacks->contains($feedback)) {
            $this->feedbacks->add($feedback);
            $feedback->setUtilisateur($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): static
    {
        if ($this->feedbacks->removeElement($feedback)) {
            if ($feedback->getUtilisateur() === $this) {
                $feedback->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BilanSante>
     */
    public function getBilanSantes(): Collection
    {
        return $this->bilanSantes;
    }

    public function addBilanSante(BilanSante $bilanSante): static
    {
        if (!$this->bilanSantes->contains($bilanSante)) {
            $this->bilanSantes->add($bilanSante);
            $bilanSante->setUtilisateur($this);
        }

        return $this;
    }

    public function removeBilanSante(BilanSante $bilanSante): static
    {
        if ($this->bilanSantes->removeElement($bilanSante)) {
            if ($bilanSante->getUtilisateur() === $this) {
                $bilanSante->setUtilisateur(null);
            }
        }

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
            $suiviSante->setUtilisateur($this);
        }

        return $this;
    }

    public function removeSuiviSante(SuiviSante $suiviSante): static
    {
        if ($this->suiviSantes->removeElement($suiviSante)) {
            if ($suiviSante->getUtilisateur() === $this) {
                $suiviSante->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Planning>
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): static
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings->add($planning);
            $planning->setUtilisateur($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): static
    {
        if ($this->plannings->removeElement($planning)) {
            if ($planning->getUtilisateur() === $this) {
                $planning->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TaskSpace>
     */
    public function getTaskSpaces(): Collection
    {
        return $this->taskSpaces;
    }

    public function addTaskSpace(TaskSpace $taskSpace): static
    {
        if (!$this->taskSpaces->contains($taskSpace)) {
            $this->taskSpaces->add($taskSpace);
            $taskSpace->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTaskSpace(TaskSpace $taskSpace): static
    {
        if ($this->taskSpaces->removeElement($taskSpace)) {
            if ($taskSpace->getUtilisateur() === $this) {
                $taskSpace->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tache>
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTache(Tache $tache): static
    {
        if (!$this->taches->contains($tache)) {
            $this->taches->add($tache);
            $tache->setUtilisateur($this);
        }

        return $this;
    }

    public function removeTache(Tache $tache): static
    {
        if ($this->taches->removeElement($tache)) {
            if ($tache->getUtilisateur() === $this) {
                $tache->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Objectif>
     */
    public function getObjectifs(): Collection
    {
        return $this->objectifs;
    }

    public function addObjectif(Objectif $objectif): static
    {
        if (!$this->objectifs->contains($objectif)) {
            $this->objectifs->add($objectif);
            $objectif->setUtilisateur($this);
        }

        return $this;
    }

    public function removeObjectif(Objectif $objectif): static
    {
        if ($this->objectifs->removeElement($objectif)) {
            if ($objectif->getUtilisateur() === $this) {
                $objectif->setUtilisateur(null);
            }
        }

        return $this;
    }
}
