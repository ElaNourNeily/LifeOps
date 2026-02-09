<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;

#[Route('/admin')]
class AdminModuleController extends AbstractController
{
    #[Route('/users', name: 'app_admin_users')]
    public function users(UtilisateurRepository $userRepo): Response
    {
        return $this->render('admin/module/list_users.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }





    #[Route('/finances', name: 'app_admin_finances')]
    public function finances(\App\Repository\DepenseRepository $depenseRepository, \App\Repository\BudgetRepository $budgetRepository): Response
    {
        $depenses = $depenseRepository->findAll();
        $budgets = $budgetRepository->findAll();

        // Calculate Expenses by Category
        $expensesByCategory = [];
        foreach ($depenses as $depense) {
            $cat = ucfirst($depense->getCategorie());
            if (!isset($expensesByCategory[$cat])) {
                $expensesByCategory[$cat] = 0;
            }
            $expensesByCategory[$cat] += $depense->getMontant();
        }

        // Calculate Revenue by Month
        $revenueByMonth = [];
        foreach ($budgets as $budget) {
            $month = $budget->getMois();
            if (!isset($revenueByMonth[$month])) {
                $revenueByMonth[$month] = 0;
            }
            $revenueByMonth[$month] += $budget->getRevenuMensuel();
        }
        
        // Sort months
        ksort($revenueByMonth);

        return $this->render('admin/module/finances.html.twig', [
            'module_name' => 'finances',
            'depenses' => $depenses,
            'budgets' => $budgets,
            'expensesByCategory' => $expensesByCategory,
            'revenueByMonth' => $revenueByMonth,
        ]);
    }

    #[Route('/finances/depense/{id}/delete', name: 'app_admin_depense_delete', methods: ['POST'])]
    public function deleteDepense(\Symfony\Component\HttpFoundation\Request $request, \App\Entity\Depense $depense, \Doctrine\ORM\EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $depense->getId(), $request->request->get('_token'))) {
            $entityManager->remove($depense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_finances', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/finances/budget/{id}/delete', name: 'app_admin_budget_delete', methods: ['POST'])]
    public function deleteBudget(\Symfony\Component\HttpFoundation\Request $request, \App\Entity\Budget $budget, \Doctrine\ORM\EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $budget->getId(), $request->request->get('_token'))) {
            $entityManager->remove($budget);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_finances', [], Response::HTTP_SEE_OTHER);
    }
}
