<?php

namespace App\Controller;

use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FinanceController extends AbstractController
{
    #[Route('/finance', name: 'app_finance_index', methods: ['GET'])]
    public function index(BudgetRepository $budgetRepository, DepenseRepository $depenseRepository, Request $request): Response
    {
        $user = $this->getUser();
        $currentMonth = (new \DateTime())->format('Y-m');
        
        $sort = $request->query->get('sort', 'date');
        $direction = $request->query->get('direction', 'DESC');
        
        $sortBudget = $request->query->get('sort_budget', 'mois');
        $dirBudget = $request->query->get('dir_budget', 'DESC');
        
        $validSorts = ['date', 'montant'];
        $validDirections = ['ASC', 'DESC'];
        
        $validBudgetSorts = ['mois', 'revenu_mensuel', 'plafond', 'economies'];
        
        if (!in_array($sort, $validSorts)) $sort = 'date';
        if (!in_array(strtoupper($direction), $validDirections)) $direction = 'DESC';
        
        if (!in_array($sortBudget, $validBudgetSorts)) $sortBudget = 'mois';
        if (!in_array(strtoupper($dirBudget), $validDirections)) $dirBudget = 'DESC';

        // Budgets Query
        $qbBudget = $budgetRepository->createQueryBuilder('b')
            ->where('b.utilisateur = :user')
            ->setParameter('user', $user);

        $searchBudget = $request->query->get('search_budget');
        if ($searchBudget) {
            $qbBudget->andWhere('b.mois LIKE :searchB OR b.revenu_mensuel LIKE :searchB')
                ->setParameter('searchB', '%' . $searchBudget . '%');
        }

        $qbBudget->orderBy('b.' . $sortBudget, $dirBudget);
        $budgets = $qbBudget->getQuery()->getResult();

        // Depenses Query
        $qbDepense = $depenseRepository->createQueryBuilder('d')
            ->where('d.utilisateur = :user')
            ->setParameter('user', $user);

        $searchDepense = $request->query->get('search_depense');
        if ($searchDepense) {
            $qbDepense->andWhere('d.titre LIKE :searchD OR d.categorie LIKE :searchD OR d.date LIKE :searchD')
                ->setParameter('searchD', '%' . $searchDepense . '%');
        }

        $qbDepense->orderBy('d.' . $sort, $direction);
        $depenses = $qbDepense->getQuery()->getResult();

        $budgetSummaries = [];
        $exceededBudgets = [];
        
        foreach ($budgets as $budget) {
            $total = 0;
            foreach ($budget->getDepenses() as $depense) {
                $total += $depense->getMontant();
            }
            
            $percentage = $budget->getPlafond() > 0 ? ($total / $budget->getPlafond()) * 100 : 0;
            
            $budgetSummaries[] = [
                'entity' => $budget,
                'totalDepenses' => $total,
            ];
            
            // Track exceeded budgets for alert
            if ($percentage > 100) {
                $exceededBudgets[] = [
                    'month' => $budget->getMois(),
                    'percentage' => round($percentage, 1),
                    'spent' => $total,
                    'plafond' => $budget->getPlafond(),
                ];
            }
        }

        return $this->render('finance/index.html.twig', [
            'budgets' => $budgets,
            'depenses' => $depenses,
            'budgetSummaries' => $budgetSummaries,
            'exceededBudgets' => $exceededBudgets,
        ]);
    }
}
