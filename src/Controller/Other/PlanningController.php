<?php

namespace App\Controller\Other;

use App\Entity\Planning;
use App\Form\PlanningType;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\StatisticsService;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planning')]
class PlanningController extends AbstractController
{
    #[Route('/', name: 'app_planning_index', methods: ['GET'])]
    public function index(
        PlanningRepository $planningRepository,
        StatisticsService $statsService,
        ChartBuilderInterface $chartBuilder
    ): Response
    {
        $user = $this->getUser();
        
        // 📈 Temps travaillé
        $weeklyData = $statsService->getWeeklyWorkedMinutes($user);
        $weeklyChart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $weeklyChart->setData([
            'labels' => array_keys($weeklyData),
            'datasets' => [[
                'label' => 'Minutes travaillées',
                'backgroundColor' => 'rgba(139, 92, 246, 0.2)',
                'borderColor' => 'rgb(139, 92, 246)',
                'borderWidth' => 1,
                'data' => array_values($weeklyData),
            ]]
        ]);
        $weeklyChart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                ],
            ],
        ]);

        // 🎯 Priorité
        $priorityData = $statsService->getPriorityDistribution($user);
        $priorityChart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $priorityChart->setData([
            'labels' => array_keys($priorityData),
            'datasets' => [[
                'backgroundColor' => ['#10b981', '#f59e0b', '#ec4899'],
                'data' => array_values($priorityData),
            ]]
        ]);

        // ✅ Complétion
        $completionRate = $statsService->getCompletionRate($user);

        $plannings = $planningRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        $groupedPlannings = [];
        foreach ($plannings as $planning) {
            $date = $planning->getDate();
            // Get Monday of that week
            $monday = clone $date;
            if ($monday->format('N') != 1) {
                $monday->modify('last monday');
            }
            $weekKey = $monday->format('Y-m-d');
            
            if (!isset($groupedPlannings[$weekKey])) {
                $groupedPlannings[$weekKey] = [
                    'start' => $monday,
                    'end' => (clone $monday)->modify('+6 days'),
                    'plannings' => [],
                    'week_number' => $monday->format('W'),
                ];
            }
            $groupedPlannings[$weekKey]['plannings'][] = $planning;
        }

        return $this->render('other/time/list.html.twig', [
            'groupedPlannings' => $groupedPlannings,
            'weeklyChart' => $weeklyChart,
            'priorityChart' => $priorityChart,
            'completionRate' => $completionRate,
        ]);
    }

    #[Route('/new', name: 'app_planning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planning = new Planning();
        $planning->setUtilisateur($this->getUser());
        $planning->setDate(new \DateTime('today'));
        $planning->setHeureDebutJournee(new \DateTime('06:00'));
        $planning->setHeureFinJournee(new \DateTime('22:00'));
        $planning->setDisponibilite(true);

        $form = $this->createForm(PlanningType::class, $planning, [
            'is_new' => true
        ]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planning);
            $entityManager->flush();

            $this->addFlash('success', 'Nouveau planning créé.');

            return $this->redirectToRoute('app_planning_index');
        }

        return $this->render('other/time/new.html.twig', [
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
            $planning->setHeureDebutJournee(new \DateTime('06:00'));
            $planning->setHeureFinJournee(new \DateTime('22:00'));
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

        return $this->render('other/time/edit.html.twig', [
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

        $referer = $request->headers->get('referer');
        if ($referer && str_contains($referer, '/planning/')) {
             return $this->redirectToRoute('app_planning_index');
        }

        return $this->redirectToRoute('app_time_index', ['date' => $dateString]);
    }
}
