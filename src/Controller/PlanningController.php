<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningType;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planning')]
class PlanningController extends AbstractController
{
    #[Route('/', name: 'app_planning_index', methods: ['GET'])]
    public function index(PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        $plannings = $planningRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        return $this->render('planning/index.html.twig', [
            'plannings' => $plannings,
        ]);
    }

    #[Route('/new', name: 'app_planning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planning = new Planning();
        $planning->setUtilisateur($this->getUser());
        $planning->setDate(new \DateTime('today'));
        $planning->setHeureDebutJournee(new \DateTime('09:00'));
        $planning->setHeureFinJournee(new \DateTime('18:00'));
        $planning->setDisponibilite(true);

        $form = $this->createForm(PlanningType::class, $planning);
        $form->remove('date'); // We will use a separate date input for creation to avoid mapping issues or allow easier selection
        $builder = $form->getConfig()->getFormFactory()->createBuilder(PlanningType::class, $planning);
        
        // Actually, let's just use PlanningType but ensure date is not readonly for "new"
        $form = $this->createForm(PlanningType::class, $planning, [
            'is_new' => true // We'll add this option
        ]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planning);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau planning créé.');

            return $this->redirectToRoute('app_planning_index');
        }

        return $this->render('planning/new.html.twig', [
            'planning' => $planning,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/{date}/edit', name: 'app_planning_edit', methods: ['GET', 'POST'])]
    public function edit(string $date, Request $request, PlanningRepository $planningRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $targetDate = new \DateTime($date);

        // Find or create the planning for this specific date and user
        $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $targetDate]);

        if (!$planning) {
            $planning = new Planning();
            $planning->setUtilisateur($user);
            $planning->setDate($targetDate);
            $planning->setHeureDebutJournee(new \DateTime('09:00'));
            $planning->setHeureFinJournee(new \DateTime('18:00'));
            $planning->setDisponibilite(true);
        }

        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planning);
            $entityManager->flush();

            $this->addFlash('success', 'La configuration du jour a été enregistrée.');

            return $this->redirectToRoute('app_time_index', ['date' => $date]);
        }

        return $this->render('planning/edit.html.twig', [
            'planning' => $planning,
            'form' => $form->createView(),
            'date' => $targetDate,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK));
    }

    #[Route('/{id}/delete', name: 'app_planning_delete', methods: ['POST'])]
    public function delete(Request $request, Planning $planning, EntityManagerInterface $entityManager): Response
    {
        $dateString = $planning->getDate()->format('Y-m-d');
        
        if ($this->isCsrfTokenValid('delete'.$planning->getId(), $request->request->get('_token'))) {
            $entityManager->remove($planning);
            $entityManager->flush();
            $this->addFlash('success', 'La configuration de la journée a été réinitialisée.');
        }

        // Logic to redirect back to where we came from
        $referer = $request->headers->get('referer');
        if ($referer && str_contains($referer, '/planning/')) {
             return $this->redirectToRoute('app_planning_index');
        }

        return $this->redirectToRoute('app_time_index', ['date' => $dateString]);
    }
}
