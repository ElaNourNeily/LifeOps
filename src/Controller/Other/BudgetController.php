<?php

namespace App\Controller\Other;

use App\Entity\Budget;
use App\Form\BudgetType;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use App\Service\ChartService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BudgetController extends AbstractController
{
    /**
     * Shared finance dashboard — shows budgets + depenses together.
     */
    #[Route('/finance', name: 'app_finance_index', methods: ['GET'])]
    public function financeIndex(Request $request, BudgetRepository $budgetRepository, DepenseRepository $depenseRepository): Response
    {
        $user = $this->getUser();

        // --- Budgets with per-budget stats ---
        $budgets = $budgetRepository->findBy(['utilisateur' => $user], ['mois' => 'DESC']);
        $budgetStats = [];
        $exceededBudgets = [];

        foreach ($budgets as $budget) {
            $totalDepenses = 0;
            foreach ($budget->getDepenses() as $dep) {
                $totalDepenses += abs($dep->getMontant());
            }
            $percentage = $budget->getPlafond() > 0 ? ($totalDepenses / $budget->getPlafond()) * 100 : 0;
            $reste = $budget->getPlafond() - $totalDepenses;

            $stat = [
                'budget' => $budget,
                'totalDepenses' => $totalDepenses,
                'reste' => $reste,
                'percentage' => $percentage,
            ];
            $budgetStats[] = $stat;

            if ($totalDepenses > $budget->getPlafond()) {
                $exceededBudgets[] = $stat;
            }
        }

        // --- Depenses (all) ---
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        // --- Search depenses ---
        $searchDepense = $request->query->get('search_depense', '');
        if ($searchDepense !== '') {
            $depenses = array_filter($depenses, function ($d) use ($searchDepense) {
                $term = mb_strtolower($searchDepense);
                return str_contains(mb_strtolower($d->getTitre() ?? ''), $term)
                    || str_contains(mb_strtolower($d->getCategorie() ?? ''), $term)
                    || str_contains($d->getDate()->format('d/m/Y'), $term);
            });
            $depenses = array_values($depenses);
        }

        // --- Sort depenses ---
        $sortDepense = $request->query->get('sort_depense', 'date');
        $dirDepense = $request->query->get('dir_depense', 'desc');
        usort($depenses, function ($a, $b) use ($sortDepense, $dirDepense) {
            $cmp = match ($sortDepense) {
                'date' => $a->getDate() <=> $b->getDate(),
                'montant' => $a->getMontant() <=> $b->getMontant(),
                default => $a->getDate() <=> $b->getDate(),
            };
            return $dirDepense === 'asc' ? $cmp : -$cmp;
        });

        // --- Search budgets ---
        $searchBudget = $request->query->get('search_budget', '');
        $filteredBudgetStats = $budgetStats;
        if ($searchBudget !== '') {
            $filteredBudgetStats = array_filter($budgetStats, function ($s) use ($searchBudget) {
                $term = mb_strtolower($searchBudget);
                $b = $s['budget'];
                return str_contains(mb_strtolower($b->getMois()), $term)
                    || str_contains((string)$b->getRevenuMensuel(), $term);
            });
            $filteredBudgetStats = array_values($filteredBudgetStats);
        }

        // --- Sort budgets ---
        $sortBudget = $request->query->get('sort_budget', 'mois');
        $dirBudget = $request->query->get('dir_budget', 'desc');
        usort($filteredBudgetStats, function ($a, $b) use ($sortBudget, $dirBudget) {
            $cmp = match ($sortBudget) {
                'mois' => $a['budget']->getMois() <=> $b['budget']->getMois(),
                'revenu' => $a['budget']->getRevenuMensuel() <=> $b['budget']->getRevenuMensuel(),
                default => $a['budget']->getMois() <=> $b['budget']->getMois(),
            };
            return $dirBudget === 'asc' ? $cmp : -$cmp;
        });

        return $this->render('other/finance/index.html.twig', [
            'budgets' => $budgets,
            'budgetStats' => $budgetStats,
            'filteredBudgetStats' => $filteredBudgetStats,
            'exceededBudgets' => $exceededBudgets,
            'depenses' => $depenses,
            'searchDepense' => $searchDepense,
            'searchBudget' => $searchBudget,
            'sortDepense' => $sortDepense,
            'dirDepense' => $dirDepense,
            'sortBudget' => $sortBudget,
            'dirBudget' => $dirBudget,
        ]);
    }

    #[Route('/finance/depenses/pdf', name: 'app_depense_pdf', methods: ['GET'])]
    public function exportDepensesPdf(DepenseRepository $depenseRepository): Response
    {
        $user = $this->getUser();
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        $html = $this->renderView('other/finance/depense/pdf.html.twig', [
            'depenses' => $depenses,
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
        $filename = 'depenses_' . date('Y-m-d_His') . '.pdf';

        return new Response(
            $pdfOutput,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    #[Route('/finance/budgets/pdf', name: 'app_budget_pdf', methods: ['GET'])]
    public function exportBudgetsPdf(BudgetRepository $budgetRepository): Response
    {
        $user = $this->getUser();
        $budgets = $budgetRepository->findBy(['utilisateur' => $user], ['mois' => 'DESC']);

        $html = $this->renderView('other/finance/budget/pdf.html.twig', [
            'budgets' => $budgets,
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
        $filename = 'budgets_' . date('Y-m-d_His') . '.pdf';

        return new Response(
            $pdfOutput,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    #[Route('/budget', name: 'app_budget_index', methods: ['GET'])]
    public function index(BudgetRepository $budgetRepository): Response
    {
        return $this->render('other/finance/budget/budgets.html.twig', [
            'budgets' => $budgetRepository->findBy(['utilisateur' => $this->getUser()], ['mois' => 'DESC']),
        ]);
    }

    #[Route('/budget/new', name: 'app_budget_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $budget = new Budget();
        $budget->setUtilisateur($this->getUser());
        $budget->setMois((new \DateTime())->format('Y-m'));

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($budget);
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/finance/budget/new.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    #[Route('/budget/{id}/edit', name: 'app_budget_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Budget $budget, EntityManagerInterface $entityManager): Response
    {
        if ($budget->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/finance/budget/edit.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    #[Route('/budget/{id}/delete', name: 'app_budget_delete', methods: ['POST'])]
    public function delete(Request $request, Budget $budget, EntityManagerInterface $entityManager): Response
    {
        if ($budget->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $budget->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($budget);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/finance/charts', name: 'app_finance_charts', methods: ['GET'])]
    public function charts(Request $request, ChartService $chartService, BudgetRepository $budgetRepository): Response
    {
        $user = $this->getUser();
        $selectedYear = $request->query->get('year') ? (int)$request->query->get('year') : null;

        // Fetch available years for the selector
        $allBudgets = $budgetRepository->findBy(['utilisateur' => $user]);
        $years = [];
        foreach ($allBudgets as $budget) {
            $year = substr($budget->getMois(), 0, 4);
            if (!in_array($year, $years)) {
                $years[] = $year;
            }
        }
        rsort($years);

        return $this->render('other/finance/charts.html.twig', [
            'expensesByCategoryData' => $chartService->getExpensesByCategoryData($user, $selectedYear),
            'monthlySpensingData' => $chartService->getMonthlySpensingTrendData($user, $selectedYear),
            'budgetVsActualData' => $chartService->getBudgetVsActualData($user, $selectedYear),
            'budgetConsumptionData' => $chartService->getBudgetConsumptionData($user, $selectedYear),
            'summaryStats' => $chartService->getSummaryStats($user, $selectedYear),
            'availableYears' => $years,
            'selectedYear' => $selectedYear,
        ]);
    }
}
