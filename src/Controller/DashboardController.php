<?php

namespace App\Controller;

use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(
        DepenseRepository $depenseRepository,
        BudgetRepository $budgetRepository,
    ): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Fetch data for the current user
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);
        $budgets = $budgetRepository->findBy(['utilisateur' => $user]);

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

        return $this->render('dashboard/index.html.twig', [
            'depenses' => $depenses,
            'recentDepenses' => array_slice($depenses, 0, 5),
            'stats' => [
                'totalDepenses' => $totalDepensesMonth,
                'budget' => $budgetAmount,
                'balance' => $balance,
            ]
        ]);
    }
}
