<?php

namespace App\Service;

use App\Entity\Utilisateur;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartService
{
    public function __construct(
        private BudgetRepository $budgetRepository,
        private DepenseRepository $depenseRepository,
        private ChartBuilderInterface $chartBuilder,
    ) {}

    /**
     * Generate data for pie chart: Expenses by category
     */
    public function getExpensesByCategoryData(Utilisateur $user, ?int $year = null): array
    {
        $criteria = ['utilisateur' => $user];
        $depenses = $this->depenseRepository->findBy($criteria);
        
        if ($year !== null) {
            $depenses = array_filter($depenses, fn($d) => (int)$d->getDate()->format('Y') === $year);
        }

        $categoryData = [];
        foreach ($depenses as $dep) {
            $cat = $dep->getCategorie() ?? 'Autre';
            if (!isset($categoryData[$cat])) {
                $categoryData[$cat] = 0;
            }
            $categoryData[$cat] += abs($dep->getMontant());
        }

        return [
            'labels' => array_keys($categoryData),
            'data' => array_values($categoryData),
            'backgroundColor' => $this->generateColors(count($categoryData)),
        ];
    }

    /**
     * Generate data for line chart: Monthly spending trend
     */
    public function getMonthlySpensingTrendData(Utilisateur $user, ?int $year = null): array
    {
        $depenses = $this->depenseRepository->findBy(['utilisateur' => $user]);
        
        if ($year !== null) {
            $depenses = array_filter($depenses, fn($d) => (int)$d->getDate()->format('Y') === $year);
        }

        $monthlyData = [];
        foreach ($depenses as $dep) {
            $monthKey = $dep->getDate()->format('Y-m');
            if (!isset($monthlyData[$monthKey])) {
                $monthlyData[$monthKey] = 0;
            }
            $monthlyData[$monthKey] += abs($dep->getMontant());
        }

        ksort($monthlyData);

        $labels = array_map(fn($m) => \DateTime::createFromFormat('Y-m', $m)->format('M Y'), array_keys($monthlyData));

        return [
            'labels' => $labels,
            'data' => array_values($monthlyData),
        ];
    }

    /**
     * Generate data for bar chart: Budget vs Actual Spending
     */
    public function getBudgetVsActualData(Utilisateur $user, ?int $year = null): array
    {
        $criteria = ['utilisateur' => $user];
        $budgets = $this->budgetRepository->findBy($criteria, ['mois' => 'ASC']);
        
        if ($year !== null) {
            $budgets = array_filter($budgets, fn($b) => str_starts_with($b->getMois(), (string)$year));
        }

        $budgetLabels = [];
        $revenues = [];
        $actualSpending = [];

        foreach ($budgets as $budget) {
            $budgetLabels[] = $budget->getMois();
            $revenues[] = $budget->getRevenuMensuel();

            $totalDepenses = 0;
            foreach ($budget->getDepenses() as $dep) {
                $totalDepenses += abs($dep->getMontant());
            }
            $actualSpending[] = $totalDepenses;
        }

        return [
            'labels' => $budgetLabels,
            'budget' => $revenues,
            'actual' => $actualSpending,
        ];
    }

    /**
     * Generate data for doughnut chart: Budget consumption percentage
     */
    public function getBudgetConsumptionData(Utilisateur $user, ?int $year = null): array
    {
        $criteria = ['utilisateur' => $user];
        $budgets = $this->budgetRepository->findBy($criteria, ['mois' => 'DESC']);
        
        if ($year !== null) {
            $budgets = array_filter($budgets, fn($b) => str_starts_with($b->getMois(), (string)$year));
        } else {
            $budgets = array_slice($budgets, 0, 5); // Last 5 budgets if no year specified
        }

        $labels = [];
        $consumedPercentages = [];
        $remainingPercentages = [];

        foreach ($budgets as $budget) {
            $labels[] = $budget->getMois();

            $totalDepenses = 0;
            foreach ($budget->getDepenses() as $dep) {
                $totalDepenses += abs($dep->getMontant());
            }

            $consumedPercent = $budget->getPlafond() > 0 ? ($totalDepenses / $budget->getPlafond()) * 100 : 0;
            $remainingPercent = 100 - $consumedPercent;

            $consumedPercentages[] = min($consumedPercent, 100);
            $remainingPercentages[] = max($remainingPercent, 0);
        }

        return [
            'labels' => array_reverse($labels),
            'consumed' => array_reverse($consumedPercentages),
            'remaining' => array_reverse($remainingPercentages),
        ];
    }

    /**
     * Get summary statistics
     */
    public function getSummaryStats(Utilisateur $user, ?int $year = null): array
    {
        $budgets = $this->budgetRepository->findBy(['utilisateur' => $user]);
        $depenses = $this->depenseRepository->findBy(['utilisateur' => $user]);

        if ($year !== null) {
            $budgets = array_filter($budgets, fn($b) => str_starts_with($b->getMois(), (string)$year));
            $depenses = array_filter($depenses, fn($d) => (int)$d->getDate()->format('Y') === $year);
        }

        $totalBudget = array_reduce($budgets, fn($sum, $b) => $sum + $b->getPlafond(), 0);
        $totalSpent = array_reduce($depenses, fn($sum, $d) => $sum + abs($d->getMontant()), 0);
        $totalRemaining = $totalBudget - $totalSpent;
        $averagePerDepense = count($depenses) > 0 ? $totalSpent / count($depenses) : 0;

        return [
            'totalBudget' => $totalBudget,
            'totalSpent' => $totalSpent,
            'totalRemaining' => $totalRemaining,
            'budgetCount' => count($budgets),
            'depenseCount' => count($depenses),
            'averagePerDepense' => $averagePerDepense,
            'spendingPercentage' => $totalBudget > 0 ? ($totalSpent / $totalBudget) * 100 : 0,
        ];
    }

    public function getExpensesByCategoryChart(Utilisateur $user, ?int $year = null): Chart
    {
        $data = $this->getExpensesByCategoryData($user, $year);
        $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => [[
                'data' => $data['data'],
                'backgroundColor' => $data['backgroundColor'],
            ]],
        ]);
        return $chart;
    }

    public function getMonthlySpensingTrendChart(Utilisateur $user, ?int $year = null): Chart
    {
        $data = $this->getMonthlySpensingTrendData($user, $year);
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => [[
                'label' => 'Dépenses',
                'data' => $data['data'],
                'borderColor' => '#3b82f6',
                'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                'tension' => 0.3,
                'fill' => true
            ]],
        ]);
        return $chart;
    }

    public function getBudgetVsActualChart(Utilisateur $user, ?int $year = null): Chart
    {
        $data = $this->getBudgetVsActualData($user, $year);
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => [
                [
                    'label' => 'Revenu',
                    'data' => $data['budget'],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)'
                ],
                [
                    'label' => 'Dépensé',
                    'data' => $data['actual'],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.8)'
                ]
            ]
        ]);
        return $chart;
    }

    public function getBudgetConsumptionChart(Utilisateur $user, ?int $year = null): Chart
    {
        $data = $this->getBudgetConsumptionData($user, $year);
        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $data['labels'],
            'datasets' => [
                [
                    'label' => 'Consommé',
                    'data' => $data['consumed'],
                    'backgroundColor' => 'rgba(239, 68, 68, 0.8)'
                ],
                [
                    'label' => 'Disponible',
                    'data' => $data['remaining'],
                    'backgroundColor' => 'rgba(34, 197, 94, 0.8)'
                ]
            ]
        ]);
        $chart->setOptions(['indexAxis' => 'y']);
        return $chart;
    }

    /**
     * Generate random but consistent colors for charts
     */
    private function generateColors(int $count): array
    {
        $colors = [
            '#3b82f6', // blue
            '#ef4444', // red
            '#10b981', // emerald
            '#f59e0b', // amber
            '#8b5cf6', // violet
            '#ec4899', // pink
            '#06b6d4', // cyan
            '#6366f1', // indigo
            '#14b8a6', // teal
            '#f97316', // orange
        ];

        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $colors[$i % count($colors)];
        }

        return $result;
    }
}
