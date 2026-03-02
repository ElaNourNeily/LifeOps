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
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
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
        PlanningRepository $planningRepository,
        ChartBuilderInterface $chartBuilder
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

        // Chart Stats
        $statsData = [
            'personal' => ['count' => 0, 'progression' => 0],
            'professional' => ['count' => 0, 'progression' => 0],
            'health' => ['count' => 0, 'progression' => 0],
            'finance' => ['count' => 0, 'progression' => 0],
            'other' => ['count' => 0, 'progression' => 0],
        ];

        foreach ($objectifs as $obj) {
            $cat = $obj->getCategorie();
            if (isset($statsData[$cat])) {
                $statsData[$cat]['count']++;
                $statsData[$cat]['progression'] += $obj->getProgression();
            } else {
                $statsData['other']['count']++;
                $statsData['other']['progression'] += $obj->getProgression();
            }
        }

        // Chart 1: Category Distribution (Doughnut)
        $chartDistrib = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chartDistrib->setData([
            'labels' => ['Personnel', 'Professionnel', 'Santé', 'Finance', 'Autre'],
            'datasets' => [
                [
                    'backgroundColor' => ['#3b82f6', '#10b981', '#ef4444', '#f59e0b', '#6b7280'],
                    'data' => [
                        $statsData['personal']['count'],
                        $statsData['professional']['count'],
                        $statsData['health']['count'],
                        $statsData['finance']['count'],
                        $statsData['other']['count'],
                    ],
                ],
            ],
        ]);
        $chartDistrib->setOptions([
            'plugins' => [
                'legend' => ['position' => 'bottom', 'labels' => ['color' => '#94a3b8']],
                'title' => ['display' => true, 'text' => 'Répartition des Domaines de Vie', 'color' => '#f1f5f9']
            ],
            'maintainAspectRatio' => false,
        ]);

        // Chart 2: Average Progression (Bar)
        $avgProgs = [];
        foreach ($statsData as $s) {
            $avgProgs[] = $s['count'] > 0 ? round($s['progression'] / $s['count']) : 0;
        }

        $chartProg = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chartProg->setData([
            'labels' => ['Personnel', 'Professionnel', 'Santé', 'Finance', 'Autre'],
            'datasets' => [
                [
                    'label' => 'Progression Moyenne (%)',
                    'backgroundColor' => 'rgba(139, 92, 246, 0.5)',
                    'borderColor' => 'rgb(139, 92, 246)',
                    'borderWidth' => 1,
                    'data' => $avgProgs,
                ],
            ],
        ]);
        $chartProg->setOptions([
            'scales' => [
                'y' => ['min' => 0, 'max' => 100, 'grid' => ['color' => 'rgba(148, 163, 184, 0.1)'], 'ticks' => ['color' => '#94a3b8']],
                'x' => ['grid' => ['display' => false], 'ticks' => ['color' => '#94a3b8']]
            ],
            'plugins' => [
                'legend' => ['display' => false],
                'title' => ['display' => true, 'text' => 'Performance par Domaine (%)', 'color' => '#f1f5f9']
            ],
            'maintainAspectRatio' => false,
        ]);

        return $this->render('other/dashboard/index.html.twig', [
            'taches' => $taches,
            'recentTaches' => array_slice($taches, 0, 5),
            'planning' => $planning,
            'objectifs' => $objectifs,
            'recentObjectifs' => array_slice($objectifs, 0, 3),
            'depenses' => $depenses,
            'recentDepenses' => array_slice($depenses, 0, 5),
            'latestBilan' => $latestBilan,
            'chartDistrib' => $chartDistrib,
            'chartProg' => $chartProg,
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
