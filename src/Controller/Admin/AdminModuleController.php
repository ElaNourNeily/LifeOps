<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;

#[Route('/admin')]
class AdminModuleController extends AbstractController
{
    #[Route('/users', name: 'app_admin_users')]
    public function users(UtilisateurRepository $userRepo): Response
    {
        return $this->render('admin/module/list_users.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }

    #[Route('/temps', name: 'app_admin_temps')]
    public function temps(\App\Repository\ActiviteRepository $activiteRepo): Response
    {
        // Fetch last 50 activities
        $activities = $activiteRepo->findBy([], ['id' => 'DESC'], 50);

        return $this->render('admin/module/temps.html.twig', [
            'module_name' => 'temps',
            'activities' => $activities,
        ]);
    }
}
