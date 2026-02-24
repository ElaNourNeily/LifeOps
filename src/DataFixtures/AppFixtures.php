<?php

namespace App\DataFixtures;

<<<<<<< HEAD
use App\Entity\Goal;
use App\Entity\HealthEntry;
use App\Entity\Task;
use App\Entity\TimeBlock;
use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
=======
use App\Entity\Activite;
use App\Entity\Budget;
use App\Entity\Depense;
use App\Entity\Objectif;
use App\Entity\Planning;
use App\Entity\SuiviSante;
use App\Entity\Tache;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

>>>>>>> ebaffe1c (first commit)
    public function load(ObjectManager $manager): void
    {
        try {
            echo "Starting fixtures load...\n";
<<<<<<< HEAD
            // Tasks
            $task1 = new Task();
            $task1->setTitle('Terminer le rapport de projet');
            $task1->setDescription('Finaliser le rapport pour le cours de gestion de projet');
            $task1->setStatus('in-progress');
            $task1->setPriority('high');
            $task1->setCategory('Etudes');
            $task1->setDueDate(new \DateTime('+2 days'));
            $manager->persist($task1);
            echo "Task 1 persisted\n";

            $task2 = new Task();
            $task2->setTitle('Acheter des courses');
            $task2->setDescription('Fruits, légumes, pain, lait');
            $task2->setStatus('todo');
            $task2->setPriority('medium');
            $task2->setCategory('Personnel');
            $task2->setDueDate(new \DateTime('+1 day'));
            $manager->persist($task2);
            echo "Task 2 persisted\n";

            $task3 = new Task();
            $task3->setTitle('Séance de sport');
            $task3->setDescription('30 min de cardio + musculation');
            $task3->setStatus('done');
            $task3->setPriority('medium');
            $task3->setCategory('Sante');
            $task3->setDueDate(new \DateTime('today'));
            $manager->persist($task3);
            echo "Task 3 persisted\n";

            // Transactions
            $tx1 = new Transaction();
            $tx1->setTitle('Salaire');
            $tx1->setAmount(1500);
            $tx1->setType('income');
            $tx1->setCategory('Salaire');
            $tx1->setDate(new \DateTime('first day of this month'));
            $manager->persist($tx1);
            echo "Transaction 1 persisted\n";

            $tx2 = new Transaction();
            $tx2->setTitle('Loyer');
            $tx2->setAmount(450);
            $tx2->setType('expense');
            $tx2->setCategory('Logement');
            $tx2->setDate(new \DateTime('first day of this month'));
            $manager->persist($tx2);
            echo "Transaction 2 persisted\n";

            // Health
            $health = new HealthEntry();
            $health->setDate(new \DateTime('today'));
            $health->setSleep(7.5);
            $health->setWater(5);
            $health->setExercise(45);
            $health->setMood(4);
            $health->setNotes('Bonne journée !');
            $manager->persist($health);
            echo "Health persisted\n";

            // Goals
            $goal1 = new Goal();
            $goal1->setTitle('Courir un semi-marathon');
            $goal1->setDescription('Préparer et participer à un semi-marathon');
            $goal1->setCategory('Sante');
            $goal1->setStatus('in-progress');
            $goal1->setProgress(45);
            $goal1->setStartDate(new \DateTime('-1 month'));
            $goal1->setEndDate(new \DateTime('+2 months'));
            $manager->persist($goal1);
            echo "Goal persisted\n";

            // TimeBlocks
            $block1 = new TimeBlock();
            $block1->setTitle('Cours de maths');
            $block1->setCategory('Etudes');
            $block1->setDate(new \DateTime('today'));
            $block1->setStartTime('08:00');
            $block1->setEndTime('10:00');
            $block1->setColor('hsl(199 89% 48%)');
            $manager->persist($block1);
            echo "TimeBlock persisted\n";
=======

            // Create User
            $user = new Utilisateur();
            $user->setEmail('admin@lifeops.com');
            $user->setNom('Admin');
            $user->setPrenom('User');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setAge(25);
            $user->setCreatedAt(new \DateTime());
            $user->setIsVerified(true);
            
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                'password123'
            );
            $user->setPassword($hashedPassword);
            
            $manager->persist($user);
            echo "User persisted\n";

            // Tasks (Tache)
            $task1 = new Tache();
            $task1->setTitre('Terminer le rapport de projet');
            $task1->setDescription('Finaliser le rapport pour le cours de gestion de projet');
            $task1->setStatut('en_cours'); // Assuming 'en_cours' for 'in-progress'
            $task1->setPriorite('haute'); // Assuming 'haute' for 'high'
            $task1->setDifficulte(3);
            $task1->setDeadline(new \DateTime('+2 days'));
            $task1->setUtilisateur($user);
            $task1->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($task1);
            echo "Tache 1 persisted\n";

            $task2 = new Tache();
            $task2->setTitre('Acheter des courses');
            $task2->setDescription('Fruits, légumes, pain, lait');
            $task2->setStatut('a_faire'); // Assuming 'a_faire' for 'todo'
            $task2->setPriorite('moyenne'); // Assuming 'moyenne' for 'medium'
            $task2->setDifficulte(1);
            $task2->setDeadline(new \DateTime('+1 day'));
            $task2->setUtilisateur($user);
            $task2->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($task2);
            echo "Tache 2 persisted\n";

            // Budget (Required for Depense)
            $budget = new Budget();
            $budget->setMois((new \DateTime())->format('F Y'));
            $budget->setRevenuMensuel(2500);
            $budget->setPlafond(2000);
            $budget->setEconomies(500);
            $budget->setUtilisateur($user);
            $manager->persist($budget);
            echo "Budget persisted\n";

            // Transactions (Depense)
            // Note: Depense seems to be only for expenses (based on name), likely no 'income' type directly mapping to 'Transaction' type 'income'.
            // Converting expense transactions only.
            
            $tx2 = new Depense();
            $tx2->setTitre('Loyer');
            $tx2->setMontant(450);
            $tx2->setCategorie('Logement');
            // 'setType' might fail if Depense doesn't have it, checking Depense.php again...
            // Depense.php has 'type_paiement' not 'type' (expense/income).
            // Assuming Depense is implicitly an expense.
            $tx2->setTypePaiement('Virement'); 
            $tx2->setDate(new \DateTime('first day of this month'));
            $tx2->setUtilisateur($user);
            $tx2->setBudget($budget);
            $manager->persist($tx2);
            echo "Depense persisted\n";

            // Health (SuiviSante)
            $health = new SuiviSante();
            $health->setDate(new \DateTime('today'));
            $health->setHeuresSommeil(7.5);
            $health->setVerresEau(5);
            $health->setMinutesActivite(45);
            $health->setHumeur(4); // Assuming 1-5 scale
            $health->setQualiteSommeil(4); // Added required field
            $health->setNotes('Bonne journée !');
            $health->setUtilisateur($user);
            $manager->persist($health);
            echo "SuiviSante persisted\n";

            // Goals (Objectif)
            $goal1 = new Objectif();
            $goal1->setTitre('Courir un semi-marathon');
            $goal1->setDescription('Préparer et participer à un semi-marathon');
            $goal1->setCategorie('Sante');
            $goal1->setStatut('en_cours');
            $goal1->setProgression(45);
            $goal1->setDateDebut(new \DateTime('-1 month'));
            $goal1->setDateFin(new \DateTime('+2 months'));
            $goal1->setUtilisateur($user);
            $manager->persist($goal1);
            echo "Objectif persisted\n";

            // Planning (Required for Activite)
            $planning = new Planning();
            $planning->setDate(new \DateTime('today'));
            $planning->setHeureDebutJournee(new \DateTime('08:00'));
            $planning->setHeureFinJournee(new \DateTime('22:00'));
            $planning->setDisponibilite(true);
            $planning->setUtilisateur($user);
            $manager->persist($planning);
            echo "Planning persisted\n";

            // TimeBlocks (Activite)
            $activite = new Activite();
            $activite->setTitre('Cours de maths');
            // Activite.php has 'etat', 'priorite', 'duree' as required ints/strings
            $activite->setEtat('planifie');
            $activite->setPriorite(2);
            $activite->setDuree(120); // 2 hours
            $activite->setHeureDebutEstimee(new \DateTime('08:00'));
            $activite->setHeureFinEstimee(new \DateTime('10:00'));
            $activite->setNiveauUrgence('moyen');
            $activite->setPlanning($planning);
            $manager->persist($activite);
            echo "Activite persisted\n";
>>>>>>> ebaffe1c (first commit)

            $manager->flush();
            echo "Flush completed\n";
        } catch (\Throwable $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
        }
    }
}
