<?php

namespace App\Controller\Other;

use App\Entity\Activite;
use App\Entity\Planning;
use App\Form\ActiviteType;
use App\Repository\ActiviteRepository;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/time')]
class ActiviteController extends AbstractController
{
    #[Route('/', name: 'app_time_index', methods: ['GET', 'POST'])]
    public function index(Request $request, PlanningRepository $planningRepository, ActiviteRepository $activiteRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $dateString = $request->query->get('date', 'now');
        try {
            $date = new \DateTime($dateString);
        } catch (\Exception $e) {
            $date = new \DateTime('today');
        }
        $view = $request->query->get('view', 'week');

        if ($view === 'day') {
            $startOfWeek = clone $date;
            $endOfWeek = clone $date;
        } else {
            $startOfWeek = (clone $date)->modify('monday this week');
            $endOfWeek = (clone $startOfWeek)->modify('sunday this week');
        }

        $activityId = $request->request->get('activity_id');
        if ($activityId) {
            $activite = $activiteRepository->find($activityId);
            if (!$activite) {
                $activite = new Activite();
            }
        } else {
             $activite = new Activite();
        }
        
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateStringSub = $request->request->all()['date'] ?? null;
             if (!$dateStringSub) {
                if ($activite->getPlanning()) {
                     $targetDate = $activite->getPlanning()->getDate();
                } else {
                     $targetDate = new \DateTime('today');
                }
            } else {
                $targetDate = new \DateTime($dateStringSub);
            }

            $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $targetDate]);
            if (!$planning) {
                $planning = new Planning();
                $planning->setUtilisateur($user);
                $planning->setDate($targetDate);
                $planning->setHeureDebutJournee(new \DateTime('06:00'));
                $planning->setHeureFinJournee(new \DateTime('22:00'));
                $entityManager->persist($planning);
            }

            $activite->setPlanning($planning);
            
            if ($activite->getHeureDebutEstimee() && $activite->getHeureFinEstimee()) {
                $start = $activite->getHeureDebutEstimee();
                $end = $activite->getHeureFinEstimee();
                if ($end < $start) { 
                    $end->modify('+1 day');
                }
                $diff = $end->diff($start);
                $minutes = ($diff->h * 60) + $diff->i;
                $activite->setDuree($minutes);

                foreach ($planning->getActivites() as $existingActivite) {
                    if ($existingActivite === $activite) continue;

                    $existingStart = $existingActivite->getHeureDebutEstimee();
                    $existingEnd = $existingActivite->getHeureFinEstimee();
                    
                    if ($existingEnd <= $existingStart) $existingEnd->modify('+1 day');

                    if ($start < $existingEnd && $end > $existingStart) {
                        $form->addError(new \Symfony\Component\Form\FormError(
                            sprintf('Conflit avec "%s" (%s - %s).', 
                                $existingActivite->getTitre(), 
                                $existingStart->format('H:i'), 
                                $existingEnd->format('H:i')
                            )
                        ));
                        break;
                    }
                }
            } else {
                 $activite->setDuree(60); 
            }

            if ($form->isValid()) {
                $entityManager->persist($planning);
                $entityManager->persist($activite);
                $entityManager->flush();

                return $this->redirectToRoute('app_time_index', ['date' => $targetDate->format('Y-m-d')]);
            }
        }
        
        $weekDays = [];
        $current = clone $startOfWeek;
        while ($current <= $endOfWeek) {
            $weekDays[] = clone $current;
            $current->modify('+1 day');
        }

        $plannings = $planningRepository->createQueryBuilder('p')
            ->where('p.utilisateur = :user')
            ->andWhere('p.date BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('start', $startOfWeek)
            ->setParameter('end', $endOfWeek)
            ->getQuery()
            ->getResult();

        $activitiesByDay = [];
        foreach ($weekDays as $day) {
            $dayKey = $day->format('Y-m-d');
            $activitiesByDay[$dayKey] = [];
        }

        foreach ($plannings as $planning) {
            $dayKey = $planning->getDate()->format('Y-m-d');
            foreach ($planning->getActivites() as $activiteItem) {
                $activitiesByDay[$dayKey][] = $activiteItem;
            }
        }

        $daysFr = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $monthsFr = [1 => 'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

        $formattedDateTitle = '';
        if ($view === 'day') {
            $w = $startOfWeek->format('w');
            $n = $startOfWeek->format('n');
            $formattedDateTitle = $daysFr[$w] . ' ' . $startOfWeek->format('j') . ' ' . $monthsFr[$n] . ' ' . $startOfWeek->format('Y');
        } else {
             $startD = $startOfWeek->format('d');
             $startM = $monthsFr[$startOfWeek->format('n')];
             $endD = $endOfWeek->format('d');
             $endM = $monthsFr[$endOfWeek->format('n')];
             $endY = $endOfWeek->format('Y');
             
             $formattedDateTitle = sprintf('%s %s - %s %s %s', $startD, substr($startM, 0, 3) . '.', $endD, substr($endM, 0, 3) . '.', $endY);
        }

        $gridStart = 6;
        $gridEnd = 22;
        
        if (count($plannings) > 0) {
            $minStart = 24;
            $maxEnd = 0;
            foreach ($plannings as $p) {
                if ($p->getHeureDebutJournee()) {
                    $hStart = (int) $p->getHeureDebutJournee()->format('G');
                    if ($hStart < $minStart) $minStart = $hStart;
                }
                if ($p->getHeureFinJournee()) {
                    $hEnd = (int) $p->getHeureFinJournee()->format('G');
                    if ($hEnd > $maxEnd) $maxEnd = $hEnd;
                }
            }
            $gridStart = $minStart;
            $gridEnd = $maxEnd - 1; 

            if ($gridEnd < $gridStart) $gridEnd = $gridStart;
        }

        return $this->render('other/time/index.html.twig', [
            'weekDays' => $weekDays,
            'activitiesByDay' => $activitiesByDay,
            'currentDate' => $date,
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'view' => $view,
            'formattedDateTitle' => $formattedDateTitle,
            'form' => $form->createView(),
            'activityId' => $activityId,
            'gridStart' => $gridStart,
            'gridEnd' => $gridEnd,
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? Response::HTTP_UNPROCESSABLE_ENTITY : Response::HTTP_OK));
    }

    #[Route('/activite/{id}/delete', name: 'app_activite_delete', methods: ['POST'])]
    public function deleteActivite(Request $request, Activite $activite, EntityManagerInterface $entityManager): Response
    {
        $date = $activite->getPlanning()->getDate()->format('Y-m-d');
        if ($this->isCsrfTokenValid('delete' . $activite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activite);
            $entityManager->flush();
            $this->addFlash('success', 'Activité supprimée.');
        }

        return $this->redirectToRoute('app_time_index', ['date' => $date]);
    }

    #[Route('/activite/new', name: 'app_activite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PlanningRepository $planningRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $dateStr = $request->query->get('date', 'now');
        $startTime = $request->query->get('start');
        
        $activite = new Activite();
        if ($startTime) {
            $activite->setHeureDebutEstimee(new \DateTime($startTime . ':00'));
            $activite->setHeureFinEstimee((new \DateTime($startTime . ':00'))->modify('+1 hour'));
        }

        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $targetDate = new \DateTime($dateStr);
            $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $targetDate]);
            
            if (!$planning) {
                $planning = new Planning();
                $planning->setUtilisateur($user);
                $planning->setDate($targetDate);
                $planning->setHeureDebutJournee(new \DateTime('06:00'));
                $planning->setHeureFinJournee(new \DateTime('22:00'));
                $planning->setDisponibilite(true);
                $entityManager->persist($planning);
            }

            $activite->setPlanning($planning);
            
            // Calculate duration
            if ($activite->getHeureDebutEstimee() && $activite->getHeureFinEstimee()) {
                $start = $activite->getHeureDebutEstimee();
                $end = $activite->getHeureFinEstimee();
                if ($end < $start) $end->modify('+1 day');
                $diff = $end->diff($start);
                $activite->setDuree(($diff->h * 60) + $diff->i);
            }

            $entityManager->persist($activite);
            $entityManager->flush();

            $this->addFlash('success', 'Activité ajoutée.');
            return $this->redirectToRoute('app_time_index', ['date' => $dateStr]);
        }

        return $this->render('other/time/new_activite.html.twig', [
            'form' => $form->createView(),
            'date' => new \DateTime($dateStr),
        ]);
    }

    #[Route('/activite/{id}/edit', name: 'app_activite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activite $activite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Recalculate duration
            if ($activite->getHeureDebutEstimee() && $activite->getHeureFinEstimee()) {
                $start = $activite->getHeureDebutEstimee();
                $end = $activite->getHeureFinEstimee();
                if ($end < $start) $end->modify('+1 day');
                $diff = $end->diff($start);
                $activite->setDuree(($diff->h * 60) + $diff->i);
            }

            $entityManager->flush();
            $this->addFlash('success', 'Activité modifiée.');
            return $this->redirectToRoute('app_time_index', ['date' => $activite->getPlanning()->getDate()->format('Y-m-d')]);
        }

        return $this->render('other/time/edit_activite.html.twig', [
            'form' => $form->createView(),
            'activite' => $activite,
        ]);
    }

    #[Route('/export', name: 'app_time_export', methods: ['GET'])]
    public function exportPdf(Request $request, PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        try {
            $date = new \DateTime($request->query->get('date', 'now'));
        } catch (\Exception $e) {
            $date = new \DateTime('today');
        }
        $startOfWeek = (clone $date)->modify('monday this week');
        $endOfWeek = (clone $startOfWeek)->modify('sunday this week');

         $plannings = $planningRepository->createQueryBuilder('p')
            ->where('p.utilisateur = :user')
            ->andWhere('p.date BETWEEN :start AND :end')
            ->setParameter('user', $user)
            ->setParameter('start', $startOfWeek)
            ->setParameter('end', $endOfWeek)
            ->getQuery()
            ->getResult();

        $activitiesByDay = [];
        $current = clone $startOfWeek;
        while($current <= $endOfWeek) {
             $activitiesByDay[$current->format('Y-m-d')] = [];
             $current->modify('+1 day');
        }

        foreach ($plannings as $planning) {
            $dayKey = $planning->getDate()->format('Y-m-d');
            foreach ($planning->getActivites() as $activite) {
                $activitiesByDay[$dayKey][] = $activite;
            }
        }

        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->setIsRemoteEnabled(true);
        $dompdf = new \Dompdf\Dompdf($options);

        $html = $this->renderView('other/time/pdf.html.twig', [
            'startOfWeek' => $startOfWeek,
            'endOfWeek' => $endOfWeek,
            'activitiesByDay' => $activitiesByDay
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="planning-'.$startOfWeek->format('Y-m-d').'.pdf"',
            ]
        );
    }
}
