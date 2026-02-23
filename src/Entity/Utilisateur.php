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
use DateTimeImmutable;

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
    #[Assert\NotBlank(message: "L'âge est obligatoire.")]
    #[Assert\Range(min: 15, max: 100, notInRangeMessage: "L'âge doit être compris entre {{ min }} et {{ max }} ans.")]
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
        
        // Ensure at least one role exists (fallback to ROLE_USER)
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        // This is a bit tricky since we store a single role string but Symfony expects array
        // We'll take the first role that isn't ROLE_USER, or default to ROLE_USER
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
    
    // Alias for getPassword to satisfy user request for mot_de_passe field
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
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
            // set the owning side to null (unless already changed)
            if ($feedback->getUtilisateur() === $this) {
                $feedback->setUtilisateur(null);
            }
        }

        return $this;
    }
    
    // Other getters and setters for relationships will be generated or inferred, 
    // but for brevity I will add them as I create the related entities to avoid errors 
    // due to missing classes. Actually, I am referencing classes that don't exist yet (Feedback, etc.).
    // PHP doesn't strictly check for existence at file creation time if namespace is correct, 
    // but IDEs might complain. Doctrine will definitely complain during schema validation if they don't exist.
    // I will proceed to create all files.
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
}
