<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
        UtilisateurRepository $userRepo
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_users' => $userRepo->count([]),
            'admin_users' => $userRepo->count(['role' => 'ROLE_ADMIN']),
        ]);
    }
}
