<?php

namespace App\Command;

use App\Entity\Goal;
use App\Entity\HealthEntry;
use App\Entity\Task;
use App\Entity\TimeBlock;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-demo-data',
    description: 'Loads demo data into the database',
)]
class LoadDemoDataCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Loading Demo Data');

        try {
            // Tasks
            $task1 = new Task();
            $task1->setTitle('Terminer le rapport de projet');
            $task1->setDescription('Finaliser le rapport pour le cours de gestion de projet');
            $task1->setStatus('in-progress');
            $task1->setPriority('high');
            $task1->setCategory('Etudes');
            $task1->setDueDate(new \DateTime('+2 days'));
            $this->entityManager->persist($task1);

            $task2 = new Task();
            $task2->setTitle('Acheter des courses');
            $task2->setDescription('Fruits, légumes, pain, lait');
            $task2->setStatus('todo');
            $task2->setPriority('medium');
            $task2->setCategory('Personnel');
            $task2->setDueDate(new \DateTime('+1 day'));
            $this->entityManager->persist($task2);

            $task3 = new Task();
            $task3->setTitle('Séance de sport');
            $task3->setDescription('30 min de cardio + musculation');
            $task3->setStatus('done');
            $task3->setPriority('medium');
            $task3->setCategory('Sante');
            $task3->setDueDate(new \DateTime('today'));
            $this->entityManager->persist($task3);

            $io->success('Tasks loaded');

            // Transactions
            $tx1 = new Transaction();
            $tx1->setTitle('Salaire');
            $tx1->setAmount(1500);
            $tx1->setType('income');
            $tx1->setCategory('Salaire');
            $tx1->setDate(new \DateTime('first day of this month'));
            $this->entityManager->persist($tx1);

            $tx2 = new Transaction();
            $tx2->setTitle('Loyer');
            $tx2->setAmount(450);
            $tx2->setType('expense');
            $tx2->setCategory('Logement');
            $tx2->setDate(new \DateTime('first day of this month'));
            $this->entityManager->persist($tx2);

            $io->success('Transactions loaded');

            // Health
            $health = new HealthEntry();
            $health->setDate(new \DateTime('today'));
            $health->setSleep(7.5);
            $health->setWater(5);
            $health->setExercise(45);
            $health->setMood(4);
            $health->setNotes('Bonne journée !');
            $this->entityManager->persist($health);

            $io->success('Health entries loaded');

            // Goals
            $goal1 = new Goal();
            $goal1->setTitle('Courir un semi-marathon');
            $goal1->setDescription('Préparer et participer à un semi-marathon');
            $goal1->setCategory('Sante');
            $goal1->setStatus('in-progress');
            $goal1->setProgress(45);
            $goal1->setStartDate(new \DateTime('-1 month'));
            $goal1->setEndDate(new \DateTime('+2 months'));
            $this->entityManager->persist($goal1);

            $io->success('Goals loaded');

            // TimeBlocks
            $block1 = new TimeBlock();
            $block1->setTitle('Cours de maths');
            $block1->setCategory('Etudes');
            $block1->setDate(new \DateTime('today'));
            $block1->setStartTime('08:00');
            $block1->setEndTime('10:00');
            $block1->setColor('hsl(199 89% 48%)');
            $this->entityManager->persist($block1);

            $io->success('Time blocks loaded');

            $this->entityManager->flush();
            $io->success('All data flushed to database successfully!');

        } catch (\Throwable $e) {
            $io->error('ERROR: ' . $e->getMessage());
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
