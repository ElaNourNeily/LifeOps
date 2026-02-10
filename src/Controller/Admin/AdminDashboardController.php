<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;
use App\Repository\FeedbackRepository;
use App\Repository\SuiviSanteRepository;
use App\Repository\ObjectifRepository;
use App\Repository\DepenseRepository;
use App\Repository\TacheRepository;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        UtilisateurRepository $userRepo,
        FeedbackRepository $feedbackRepo,
        SuiviSanteRepository $healthRepo,
        ObjectifRepository $goalRepo,
        DepenseRepository $expenseRepo,
        TacheRepository $taskRepo
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_users' => $userRepo->count([]),
            'total_feedbacks' => $feedbackRepo->count([]),
            'total_health_records' => $healthRepo->count([]),
            'total_goals' => $goalRepo->count([]),
            'total_tasks' => $taskRepo->count([]),
            'total_expenses' => $expenseRepo->count([]),
            'expenses_by_category' => $expenseRepo->getTotalByCategorie(),
            // Example of more specific stats
            'admin_users' => $userRepo->count(['role' => 'ROLE_ADMIN']),
            'new_feedbacks' => $feedbackRepo->count([]), // Adjust filters if needed
        ]);
    }
}
