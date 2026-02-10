<?php

namespace App\Controller;

use App\Repository\PlanningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(
        PlanningRepository $planningRepository
    ): Response
    {
        $user = $this->getUser();
        // Authentication is handled by AutoAuthenticator automatically

        $today = new \DateTime('today');
        
        // Fetch all plannings that have at least one activity, starting from today
        $activePlannings = $planningRepository->createQueryBuilder('p')
            ->innerJoin('p.activites', 'a')
            ->where('p.utilisateur = :user')
            ->andWhere('p.date >= :today')
            ->setParameter('user', $user)
            ->setParameter('today', $today)
            ->orderBy('p.date', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('dashboard/index.html.twig', [
            'activePlannings' => $activePlannings,
        ]);
    }
}
