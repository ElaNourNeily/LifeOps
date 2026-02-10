<?php

namespace App\Controller;

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
class TimeController extends AbstractController
{
    #[Route('/', name: 'app_time_index', methods: ['GET', 'POST'])]
    public function index(Request $request, PlanningRepository $planningRepository, ActiviteRepository $activiteRepository, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $date = new \DateTime($request->query->get('date', 'now'));
        $view = $request->query->get('view', 'week'); // 'week' or 'day'

        if ($view === 'day') {
            $startOfWeek = clone $date;
            $endOfWeek = clone $date;
        } else {
            // Ensure we invoke "monday this week" correctly
            $startOfWeek = (clone $date)->modify('monday this week');
            $endOfWeek = (clone $startOfWeek)->modify('sunday this week');
        }

        // Handle Form Submission
        $activityId = $request->request->get('activity_id');
        if ($activityId) {
            $activite = $activiteRepository->find($activityId);
            if (!$activite) {
                // If not found, fallback to new (or error) - avoiding crash
                $activite = new Activite();
            }
        } else {
             $activite = new Activite();
        }
        
        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             // Retrieve date from request or default
            $dateString = $request->request->all()['date'] ?? null;
             if (!$dateString) {
                // For Edit: use existing date if not provided?
                // But form is submitted, so date input should be there (it's outside the Symfony form in template)
                if ($activite->getPlanning()) {
                     $targetDate = $activite->getPlanning()->getDate();
                } else {
                     $targetDate = new \DateTime('today');
                }
            } else {
                $targetDate = new \DateTime($dateString);
            }

            // Find or create planning
            $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $targetDate]);
            if (!$planning) {
                $planning = new Planning();
                $planning->setUtilisateur($user);
                $planning->setDate($targetDate);
                $planning->setHeureDebutJournee(new \DateTime('09:00'));
                $planning->setHeureFinJournee(new \DateTime('18:00'));
                $entityManager->persist($planning);
            }

            $activite->setPlanning($planning);
            
             // Calculate duration & Correct End Time (Handle overnight)
            if ($activite->getHeureDebutEstimee() && $activite->getHeureFinEstimee()) {
                $start = $activite->getHeureDebutEstimee();
                $end = $activite->getHeureFinEstimee();
                if ($end <= $start) { 
                    // Assume overnight or just fix it? 
                    // User requirement says "End must be > Start" (client validation).
                    // Server side we can enforce or adapt. 
                    // If strict validation (Assert\GreaterThan), it fails.
                    // But if we want to allow overnight, we modify +1 day.
                    // Let's assume strict single-day for now or follow existing logic.
                    // Existing logic was: if ($end < $start) $end->modify('+1 day');
                    // But the loop below depends on correct comparison.
                    if ($end < $start) $end->modify('+1 day');
                }
                $diff = $end->diff($start);
                $minutes = ($diff->h * 60) + $diff->i;
                $activite->setDuree($minutes);

                // Overlap Check
                foreach ($planning->getActivites() as $existingActivite) {
                    // Skip self (for Edit)
                    if ($existingActivite === $activite) continue;

                    $existingStart = $existingActivite->getHeureDebutEstimee();
                    $existingEnd = $existingActivite->getHeureFinEstimee();
                    
                    if ($existingEnd <= $existingStart) $existingEnd->modify('+1 day'); // Handle existing overnight too?

                    // Check overlap: StartA < EndB AND EndA > StartB
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
                 $activite->setDuree(60); // Default
            }

            if ($form->isValid()) {
                $entityManager->persist($planning);
                $entityManager->persist($activite);
                $entityManager->flush();

                return $this->redirectToRoute('app_time_index', ['date' => $targetDate->format('Y-m-d')]);
            }
        }
        
        // ... (Rest of the rendering logic) ...

        // Create specific dates for each day of the week for the header
        $weekDays = [];
        $current = clone $startOfWeek;
        while ($current <= $endOfWeek) {
            $weekDays[] = clone $current;
            $current->modify('+1 day');
        }

        // Fetch activities for this week
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

        // Manual fallback for French date formatting since intl extension might be missing
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
             
             // Short format for week: 09 fév - 15 fév 2026
             $formattedDateTitle = sprintf('%s %s - %s %s %s', $startD, substr($startM, 0, 3) . '.', $endD, substr($endM, 0, 3) . '.', $endY);
        }

        // Calculate grid range
        $gridStart = 7; // Default
        $gridEnd = 20;  // Default
        
        $planningsCount = count($plannings);
        if ($planningsCount > 0) {
            $minStart = 24;
            $maxEnd = 0;
            foreach ($plannings as $p) {
                if ($p->getHeureDebutJournee()) {
                    $hStart = (int) $p->getHeureDebutJournee()->format('G');
                    if ($hStart < $minStart) $minStart = $hStart;
                }
                if ($p->getHeureFinJournee()) {
                    $hEnd = (int) $p->getHeureFinJournee()->format('G');
                    // If exactly on the hour, keep it. If min > 0, we might need next hour but usually grid is hourly.
                    if ($hEnd > $maxEnd) $maxEnd = $hEnd;
                }
            }
            // Range without padding to match user expectations
            $gridStart = $minStart;
            // gridEnd is the START of the last block. 
            // If they want to finish at 22:00, the last block starts at 21:00.
            $gridEnd = $maxEnd - 1; 

            // Safety checks
            if ($gridEnd < $gridStart) $gridEnd = $gridStart;
        }

        return $this->render('time/index.html.twig', [
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
        $entityManager->remove($activite);
        $entityManager->flush();

        return $this->redirectToRoute('app_time_index', ['date' => $date]);
    }

    #[Route('/export', name: 'app_time_export', methods: ['GET'])]
    public function exportPdf(Request $request, PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
         $date = new \DateTime($request->query->get('date', 'now'));
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
        // Fill empty days
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

        // Configure Dompdf
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'Arial');
        $options->setIsRemoteEnabled(true);
        $dompdf = new \Dompdf\Dompdf($options);

        $html = $this->renderView('time/pdf.html.twig', [
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
