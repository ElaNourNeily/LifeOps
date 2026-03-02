<?php

namespace App\Command;

use App\Service\AIService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test-ai',
    description: 'Teste la connexion à l\'API Gemini',
)]
class TestAICommand extends Command
{
    private $aiService;

    public function __construct(AIService $aiService)
    {
        parent::__construct();
        $this->aiService = $aiService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $testGoal = "Peindre un tableau abstrait avec de l'acrylique";
        
        $io->title("Test de l'API Gemini");
        $io->info("Objectif de test : " . $testGoal);
        
        $io->note("Demande en cours à Gemini...");
        
        $steps = $this->aiService->suggestSteps($testGoal);
        
        if (empty($steps)) {
            $io->error("Aucune étape générée.");
            return Command::FAILURE;
        }

        // Vérification plus robuste si c'est un mock ou de l'IA
        $isMock = false;
        $genericStart = "Préciser l'objectif";
        $eauFallback = "Acheter une gourde";
        
        if (str_contains($steps[0], $genericStart) || str_contains($steps[0], $eauFallback)) {
            $isMock = true;
        }

        if ($isMock) {
            $io->warning("L'API a échoué (Erreur 429 ou autre) et le système a utilisé une réponse de SECOURS.");
            $io->note("L'erreur 429 (Quota Exceeded) signifie que vous avez atteint la limite gratuite de Google ou que votre clé est restreinte.");
        } else {
            $io->success("Succès ! L'IA Gemini a généré ces étapes uniques :");
        }

        foreach ($steps as $index => $step) {
            $io->writeln(($index + 1) . ". " . $step);
        }

        return Command::SUCCESS;
    }
}
