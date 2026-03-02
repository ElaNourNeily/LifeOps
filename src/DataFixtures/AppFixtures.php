<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\HealthEntry;
use App\Entity\Task;
use App\Entity\TimeBlock;
use App\Entity\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        try {
            echo "Starting fixtures load...\n";
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

            $manager->flush();
            echo "Flush completed\n";
        } catch (\Throwable $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
            echo $e->getTraceAsString() . "\n";
        }
    }
}
