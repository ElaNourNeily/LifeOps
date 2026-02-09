<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Entity\Budget;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use App\Repository\BudgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

#[Route('/depenses')]
class DepenseController extends AbstractController
{
    #[Route('/new', name: 'app_depense_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, BudgetRepository $budgetRepository): Response
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
            // Only auto-assign budget if not selected manually
            if (!$depense->getBudget()) {
                $expenseDate = $depense->getDate();
                $month = $expenseDate->format('Y-m');
                
                $targetBudget = $budgetRepository->findOneBy([
                    'utilisateur' => $this->getUser(),
                    'mois' => $month
                ]);

                if (!$targetBudget) {
                    // Create new budget from previous month or default
                    $targetBudget = new Budget();
                    $targetBudget->setUtilisateur($this->getUser());
                    $targetBudget->setMois($month);
                    
                    // Try to get values from most recent budget
                    $lastBudget = $budgetRepository->findOneBy(
                        ['utilisateur' => $this->getUser()], 
                        ['mois' => 'DESC']
                    );

                    if ($lastBudget) {
                        $targetBudget->setRevenuMensuel($lastBudget->getRevenuMensuel());
                        $targetBudget->setPlafond($lastBudget->getPlafond());
                        $targetBudget->setEconomies($lastBudget->getEconomies());
                    } else {
                        // Defaults
                        $targetBudget->setRevenuMensuel(0);
                        $targetBudget->setPlafond(0);
                        $targetBudget->setEconomies(0);
                    }
                    
                    $entityManager->persist($targetBudget);
                }
                if (!$targetBudget) {
                    $form->get('budget')->addError(new \Symfony\Component\Form\FormError('Aucun budget trouvé pour ce mois. Veuillez créer un budget pour ' . $month . ' d\'abord.'));
                    return $this->render('depense/new.html.twig', [
                        'depense' => $depense,
                        'form' => $form,
                    ]);
                }
                $depense->setBudget($targetBudget);
            }

            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depense/new.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depense_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depense $depense, EntityManagerInterface $entityManager): Response
    {
        // Security check - ensure user owns this depense
        if ($depense->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Only auto-assign budget if not selected manually (or if user cleared it)
            if (!$depense->getBudget()) {
                $expenseDate = $depense->getDate();
                $month = $expenseDate->format('Y-m');
                
                $budgetRepository = $entityManager->getRepository(Budget::class);
                $targetBudget = $budgetRepository->findOneBy([
                    'utilisateur' => $this->getUser(),
                    'mois' => $month
                ]);

                if (!$targetBudget) {
                    // Create new budget from previous month or default
                    $targetBudget = new Budget();
                    $targetBudget->setUtilisateur($this->getUser());
                    $targetBudget->setMois($month);
                    
                    // Try to get values from most recent budget
                    $lastBudget = $budgetRepository->findOneBy(
                        ['utilisateur' => $this->getUser()], 
                        ['mois' => 'DESC']
                    );

                    if ($lastBudget) {
                        $targetBudget->setRevenuMensuel($lastBudget->getRevenuMensuel());
                        $targetBudget->setPlafond($lastBudget->getPlafond());
                        $targetBudget->setEconomies($lastBudget->getEconomies());
                    } else {
                        $targetBudget->setRevenuMensuel(0);
                        $targetBudget->setPlafond(0);
                        $targetBudget->setEconomies(0);
                    }
                    
                    $entityManager->persist($targetBudget);
                }
                $depense->setBudget($targetBudget);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_depense_delete', methods: ['POST'])]
    public function delete(Request $request, Depense $depense, EntityManagerInterface $entityManager): Response
    {
        // Security check - ensure user owns this depense
        if ($depense->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $depense->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($depense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/export/pdf', name: 'app_depense_export_pdf', methods: ['GET'])]
    public function exportPdf(DepenseRepository $depenseRepository, Request $request): Response
    {
        $user = $this->getUser();
        
        $sort = $request->query->get('sort', 'date');
        $direction = $request->query->get('direction', 'DESC');
        
        // Depenses Query
        $qbDepense = $depenseRepository->createQueryBuilder('d')
            ->where('d.utilisateur = :user')
            ->setParameter('user', $user);

        $searchDepense = $request->query->get('search');
        if ($searchDepense) {
            $qbDepense->andWhere('d.titre LIKE :searchD OR d.categorie LIKE :searchD OR d.date LIKE :searchD')
                ->setParameter('searchD', '%' . $searchDepense . '%');
        }

        $qbDepense->orderBy('d.' . $sort, $direction);
        $depenses = $qbDepense->getQuery()->getResult();

        $html = $this->renderView('depense/pdf/depenses.html.twig', [
            'depenses' => $depenses,
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
                'Content-Disposition' => 'attachment; filename="depenses.pdf"',
            ]
        );
    }
}
