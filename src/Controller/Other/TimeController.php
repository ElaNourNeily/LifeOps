<?php

namespace App\Controller\Other;

use App\Entity\Activite;
use App\Entity\Planning;
use App\Form\ActiviteType;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/time')]
class TimeController extends AbstractController
{
    #[Route('/', name: 'app_time_index', methods: ['GET'])]
    public function index(PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        $today = new \DateTime('today');
        
        $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $today]);

        // If no planning exists for today, we could implicitly create one or just show empty state
        // Let's create one if it doesn't exist for better UX
        if (!$planning) {
             // We won't persist it yet, just show empty
             $planning = null; 
        }

        return $this->render('other/time/index.html.twig', [
            'planning' => $planning,
            'today' => $today,
        ]);
    }

    #[Route('/activite/new', name: 'app_activite_new', methods: ['GET', 'POST'])]
    public function newActivite(Request $request, EntityManagerInterface $entityManager, PlanningRepository $planningRepository): Response
    {
        $user = $this->getUser();
        $today = new \DateTime('today');
        
        // Find or create planning for today
        $planning = $planningRepository->findOneBy(['utilisateur' => $user, 'date' => $today]);
        if (!$planning) {
            $planning = new Planning();
            $planning->setUtilisateur($user);
            $planning->setDate($today);
            $planning->setHeureDebutJournee(new \DateTime('09:00'));
            $planning->setHeureFinJournee(new \DateTime('18:00'));
            $entityManager->persist($planning);
        }

        $activite = new Activite();
        $activite->setPlanning($planning);
        $activite->setPriorite(2);
        $activite->setEtat('todo');
        $activite->setNiveauUrgence(1);

        $form = $this->createForm(ActiviteType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Calculate duration
            if ($activite->getHeureDebutEstimee() && $activite->getHeureFinEstimee()) {
                $start = $activite->getHeureDebutEstimee();
                $end = $activite->getHeureFinEstimee();
                
                // Handle case where end time is next day (though unlikely for daily planning)
                if ($end < $start) {
                    $end->modify('+1 day');
                }
                
                $diff = $end->diff($start);
                $minutes = ($diff->h * 60) + $diff->i;
                $activite->setDuree($minutes);
            } else {
                 $activite->setDuree(0); // Default if times are missing
            }

            $entityManager->persist($planning); // Ensure planning is persisted
            $entityManager->persist($activite);
            $entityManager->flush();

            return $this->redirectToRoute('app_time_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/time/new_activite.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }
}
