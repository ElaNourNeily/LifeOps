<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;
<<<<<<< HEAD
=======
use App\Repository\FeedbackRepository;
>>>>>>> ebaffe1c (first commit)

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

<<<<<<< HEAD
    #[Route('/temps', name: 'app_admin_temps')]
    public function temps(\App\Repository\ActiviteRepository $activiteRepo): Response
    {
        // Fetch last 50 activities
        $activities = $activiteRepo->findBy([], ['id' => 'DESC'], 50);

        return $this->render('admin/module/temps.html.twig', [
            'module_name' => 'temps',
            'activities' => $activities,
=======
    #[Route('/feedback', name: 'app_admin_feedback')]
    public function feedback(FeedbackRepository $feedbackRepo): Response
    {
        return $this->render('admin/module/list_feedbacks.html.twig', [
            'feedbacks' => $feedbackRepo->findAll(),
        ]);
    }

    #[Route('/sante', name: 'app_admin_sante')]
    public function sante(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'sante',
        ]);
    }

    #[Route('/finances', name: 'app_admin_finances')]
    public function finances(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'finances',
        ]);
    }

    #[Route('/temps', name: 'app_admin_temps')]
    public function temps(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'temps',
        ]);
    }

    #[Route('/taches', name: 'app_admin_taches')]
    public function taches(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'taches',
        ]);
    }

    #[Route('/objectifs', name: 'app_admin_objectifs')]
    public function objectifs(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'objectifs',
>>>>>>> ebaffe1c (first commit)
        ]);
    }
}
