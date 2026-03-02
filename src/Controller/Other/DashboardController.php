<?php

namespace App\Controller\Other;

use App\Repository\BilanSanteRepository;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use App\Repository\ObjectifRepository;
use App\Repository\PlanningRepository;
use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        TacheRepository $tacheRepository,
        DepenseRepository $depenseRepository,
        BudgetRepository $budgetRepository,
        BilanSanteRepository $bilanSanteRepository,
        ObjectifRepository $objectifRepository,
        PlanningRepository $planningRepository
    ): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Fetch data for the current user
        $taches = $tacheRepository->findBy(['utilisateur' => $user], ['deadline' => 'ASC']);
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);
        $budgets = $budgetRepository->findBy(['utilisateur' => $user]);
        $bilanSantes = $bilanSanteRepository->findBy(['utilisateur' => $user], ['date_fin' => 'DESC']);
        $objectifs = $objectifRepository->findBy(['utilisateur' => $user], ['date_fin' => 'ASC']);
        
        $today = new \DateTime('today');
        $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $today]);

        // Calculate stats
        $todoTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'todo'));
        $inProgressTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'in-progress'));
        $doneTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'done'));

        // Finance stats
        $currentMonth = (new \DateTime())->format('Y-m');
        $totalDepensesMonth = 0;
        foreach ($depenses as $depense) {
            if ($depense->getDate()->format('Y-m') === $currentMonth) {
                $totalDepensesMonth += $depense->getMontant();
            }
        }
        
        // Find current month budget
        $currentBudget = null;
        // In a real app we'd match the 'mois' string field more carefully or use dates
        // For now let's just take the first budget found or 0
        $budgetAmount = $budgets[0] ?? null ? $budgets[0]->getRevenuMensuel() : 0; 
        $balance = $budgetAmount - $totalDepensesMonth;

        $latestBilan = $bilanSantes[0] ?? null;
        
        $activeObjectifs = count(array_filter($objectifs, fn($o) => $o->getStatut() === 'in-progress'));

        return $this->render('other/dashboard/index.html.twig', [
            'taches' => $taches,
            'recentTaches' => array_slice($taches, 0, 5),
            'planning' => $planning,
            'objectifs' => $objectifs,
            'recentObjectifs' => array_slice($objectifs, 0, 3),
            'depenses' => $depenses,
            'recentDepenses' => array_slice($depenses, 0, 5),
            'latestBilan' => $latestBilan,
            'stats' => [
                'todoTasks' => $todoTasks,
                'inProgressTasks' => $inProgressTasks,
                'doneTasks' => $doneTasks,
                'totalDepenses' => $totalDepensesMonth,
                'budget' => $budgetAmount,
                'balance' => $balance,
                'activeObjectifs' => $activeObjectifs,
            ]
        ]);
    }
}
