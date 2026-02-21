<?php

namespace App\Controller\Other;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/depense')]
class DepenseController extends AbstractController
{
    #[Route('/', name: 'app_depense_index', methods: ['GET'])]
    public function index(DepenseRepository $depenseRepository): Response
    {
        return $this->render('other/finance/depense/depenses.html.twig', [
            'depenses' => $depenseRepository->findBy(['utilisateur' => $this->getUser()], ['date' => 'DESC']),
        ]);
    }

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
            // Automate budget linkage based on date
            $month = $depense->getDate()->format('Y-m');
            $budget = $budgetRepository->findOneBy(['utilisateur' => $this->getUser(), 'mois' => $month]);
            
            if (!$budget) {
                $this->addFlash('error', 'Aucun budget trouvé pour le mois ' . $month . '. Veuillez créer le budget d\'abord.');
                return $this->render('other/finance/depense/new.html.twig', [
                    'depense' => $depense,
                    'form' => $form->createView(),
                ]);
            }
            $depense->setBudget($budget);

            /** @var UploadedFile $receiptFile */
            $receiptFile = $form->get('receiptImage')->getData();

            if ($receiptFile) {
                $newFilename = uniqid().'.'.$receiptFile->guessExtension();

                try {
                    $receiptFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/receipts',
                        $newFilename
                    );
                    $depense->setReceiptImage($newFilename);
                } catch (FileException $e) {
                    // handle exception
                }
            }

            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/finance/depense/new.html.twig', [
            'depense' => $depense,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depense_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depense $depense, EntityManagerInterface $entityManager, BudgetRepository $budgetRepository): Response
    {
        if ($depense->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Automate budget linkage based on date
            $month = $depense->getDate()->format('Y-m');
            $budget = $budgetRepository->findOneBy(['utilisateur' => $this->getUser(), 'mois' => $month]);
            
            if (!$budget) {
                $this->addFlash('error', 'Aucun budget trouvé pour le mois ' . $month . '. Dépense non enregistrée.');
                return $this->render('other/finance/depense/edit.html.twig', [
                    'depense' => $depense,
                    'form' => $form->createView(),
                ]);
            }
            $depense->setBudget($budget);

            $entityManager->flush();

            return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/finance/depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_depense_delete', methods: ['POST'])]
    public function delete(Request $request, Depense $depense, EntityManagerInterface $entityManager): Response
    {
        if ($depense->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete' . $depense->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($depense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_finance_index', [], Response::HTTP_SEE_OTHER);
    }
}
