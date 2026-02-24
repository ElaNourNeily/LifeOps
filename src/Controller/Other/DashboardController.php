<?php

namespace App\Controller\Other;

use App\Repository\TacheRepository;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use App\Repository\BilanSanteRepository;
use App\Repository\ObjectifRepository;
use App\Repository\PlanningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        TacheRepository $tacheRepo,
        BudgetRepository $budgetRepo,
        DepenseRepository $depenseRepo,
        BilanSanteRepository $bilanRepo,
        ObjectifRepository $objectifRepo,
        PlanningRepository $planningRepo
    ): Response {
        $user = $this->getUser();
        $currentMonth = (new \DateTime())->format('Y-m');

        // Task Stats
        $allTasks = $tacheRepo->findBy(['utilisateur' => $user]);
        $stats = [
            'inProgressTasks' => count(array_filter($allTasks, fn($t) => $t->getStatut() === 'in-progress')),
            'todoTasks'       => count(array_filter($allTasks, fn($t) => $t->getStatut() === 'todo')),
            'doneTasks'       => count(array_filter($allTasks, fn($t) => $t->getStatut() === 'done')),
        ];

        // Finance Stats
        $budgets = $budgetRepo->findBy(['utilisateur' => $user], ['mois' => 'DESC']);
        $currentBudget = null;
        foreach ($budgets as $b) {
            if ($b->getMois() === $currentMonth) {
                $currentBudget = $b;
                break;
            }
        }

        $allDepenses = $depenseRepo->findBy(['utilisateur' => $user]);
        $totalDepensesMonth = 0;
        foreach ($allDepenses as $depense) {
            if ($depense->getDate()->format('Y-m') === $currentMonth) {
                $totalDepensesMonth += $depense->getMontant();
            }
        }

        $stats['budget'] = $currentBudget ? $currentBudget->getMontant() : 0;
        $stats['totalDepenses'] = $totalDepensesMonth;
        $stats['balance'] = $stats['budget'] - $totalDepensesMonth;

        // Health Stats
        $bilans = $bilanRepo->findBy(['utilisateur' => $user], ['date_fin' => 'DESC'], 1);
        $latestBilan = !empty($bilans) ? $bilans[0] : null;

        // Goals Stats
        $activeObjectifs = $objectifRepo->count(['utilisateur' => $user]); // Simplified: all for now or filter by status if exists
        $stats['activeObjectifs'] = $activeObjectifs;

        // Recent Tasks
        $recentTaches = $tacheRepo->findBy(['utilisateur' => $user], ['id' => 'DESC'], 5);

        // Planning du jour
        $today = new \DateTime();
        $planning = $planningRepo->findOneBy([
            'utilisateur' => $user,
            'date' => $today
        ]);
        
        // If not found by exact date object, try by formatted string if Repository supports it or search broad
        if (!$planning) {
            $plannings = $planningRepo->findBy(['utilisateur' => $user]);
            foreach ($plannings as $p) {
                if ($p->getDate()->format('Y-m-d') === $today->format('Y-m-d')) {
                    $planning = $p;
                    break;
                }
            }
        }

        return $this->render('other/dashboard/index.html.twig', [
            'stats' => $stats,
            'latestBilan' => $latestBilan,
            'recentTaches' => $recentTaches,
            'planning' => $planning,
        ]);
    }
}
