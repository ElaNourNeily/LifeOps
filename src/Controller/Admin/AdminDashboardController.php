<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;
use App\Repository\DepenseRepository;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        UtilisateurRepository $userRepo,
        DepenseRepository $expenseRepo,
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_users' => $userRepo->count([]),
            'total_expenses' => $expenseRepo->count([]),
            'expenses_by_category' => $expenseRepo->getTotalByCategorie(),
            // Example of more specific stats
            'admin_users' => $userRepo->count(['role' => 'ROLE_ADMIN']),
        ]);
    }
}
