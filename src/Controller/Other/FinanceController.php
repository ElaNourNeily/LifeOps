<?php

namespace App\Controller\Other;

use App\Entity\Budget;
use App\Entity\Depense;
use App\Form\BudgetType;
use App\Form\DepenseType;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/finance')]
class FinanceController extends AbstractController
{
    #[Route('/', name: 'app_finance_index', methods: ['GET'])]
    public function index(BudgetRepository $budgetRepository, DepenseRepository $depenseRepository): Response
    {
        $user = $this->getUser();
        $currentMonth = (new \DateTime())->format('Y-m');
        
        $budgets = $budgetRepository->findBy(['utilisateur' => $user], ['mois' => 'DESC']);
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        // Calculate stats for current month
        $currentBudget = null;
        foreach ($budgets as $b) {
            if ($b->getMois() === $currentMonth) {
                $currentBudget = $b;
                break;
            }
        }

        $totalDepensesMonth = 0;
        foreach ($depenses as $depense) {
            if ($depense->getDate()->format('Y-m') === $currentMonth) {
                $totalDepensesMonth += $depense->getMontant();
            }
        }

        return $this->render('other/finance/index.html.twig', [
            'budgets' => $budgets,
            'depenses' => $depenses,
            'currentBudget' => $currentBudget,
            'totalDepensesMonth' => $totalDepensesMonth,
        ]);
    }

    #[Route('/budget/new', name: 'app_budget_new', methods: ['GET', 'POST'])]
    public function newBudget(Request $request, EntityManagerInterface $entityManager): Response
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

        return $this->render('other/finance/new_budget.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    #[Route('/depense/new', name: 'app_depense_new', methods: ['GET', 'POST'])]
    public function newDepense(Request $request, EntityManagerInterface $entityManager, BudgetRepository $budgetRepository): Response
    {
        $depense = new Depense();
        $depense->setUtilisateur($this->getUser());
        $depense->setDate(new \DateTime());

        // Try to pre-select current budget
        $currentMonth = (new \DateTime())->format('Y-m');
        $budget = $budgetRepository->findOneBy(['utilisateur' => $this->getUser(), 'mois' => $currentMonth]);
        if ($budget) {
            $depense->setBudget($budget);
        }

        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/finance/new_depense.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }
}
