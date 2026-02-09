<?php

namespace App\Controller;

use App\Entity\Budget;
use App\Form\BudgetType;
use App\Repository\BudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Form\FormError;

#[Route('/budgets')]
class BudgetController extends AbstractController
{
    #[Route('/new', name: 'app_budget_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $budget = new Budget();
        $budget->setUtilisateur($this->getUser());
        $budget->setMois((new \DateTime())->format('Y-m'));

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if budget already exists for this month
            $existingBudget = $entityManager->getRepository(Budget::class)->findOneBy([
                'utilisateur' => $this->getUser(),
                'mois' => $budget->getMois()
            ]);

            if ($existingBudget) {
                $form->get('mois')->addError(new FormError('Un budget existe déjà pour ce mois.'));
                return $this->render('budget/new.html.twig', [
                    'budget' => $budget,
                    'form' => $form,
                ]);
            }

            $entityManager->persist($budget);
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('budget/new.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_budget_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Budget $budget, EntityManagerInterface $entityManager): Response
    {
        // Security check - ensure user owns this budget
        if ($budget->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(BudgetType::class, $budget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('budget/edit.html.twig', [
            'budget' => $budget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_budget_delete', methods: ['POST'])]
    public function delete(Request $request, Budget $budget, EntityManagerInterface $entityManager): Response
    {
        // Security check - ensure user owns this budget
        if ($budget->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $budget->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($budget);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/export/pdf', name: 'app_budget_export_pdf', methods: ['GET'])]
    public function exportPdf(BudgetRepository $budgetRepository, Request $request): Response
    {
        $user = $this->getUser();
        
        $sortBudget = $request->query->get('sort', 'mois');
        $dirBudget = $request->query->get('direction', 'DESC');
        
        // Budgets Query
        $qbBudget = $budgetRepository->createQueryBuilder('b')
            ->where('b.utilisateur = :user')
            ->setParameter('user', $user);

        $searchBudget = $request->query->get('search');
        if ($searchBudget) {
            $qbBudget->andWhere('b.mois LIKE :searchB OR b.revenu_mensuel LIKE :searchB')
                ->setParameter('searchB', '%' . $searchBudget . '%');
        }

        $qbBudget->orderBy('b.' . $sortBudget, $dirBudget);
        $budgets = $qbBudget->getQuery()->getResult();

        $html = $this->renderView('budget/pdf/budgets.html.twig', [
            'budgets' => $budgets,
            'user' => $user,
        ]);

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="budgets.pdf"',
            ]
        );
    }
}
