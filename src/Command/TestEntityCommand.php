<?php

namespace App\Command;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:test-entity',
    description: 'Tests entity persistence',
)]
class TestEntityCommand extends Command
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Starting test...');

        try {
            $task = new Task();
            $task->setTitle('Test Task');
            $task->setDescription('This is a test');
            $task->setCategory('Test');
            
            $output->writeln('Persisting task...');
            $this->entityManager->persist($task);
            
            $output->writeln('Flushing...');
            $this->entityManager->flush();
            
            $output->writeln('Task created with ID: ' . $task->getId());
        } catch (\Throwable $e) {
            $output->writeln('ERROR: ' . $e->getMessage());
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
