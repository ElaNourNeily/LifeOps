<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // If the user is already logged in, redirect them to the appropriate dashboard
        $user = $this->getUser();
        if ($user) {
            $roles = method_exists($user, 'getRoles') ? $user->getRoles() : [];
            if (in_array('ROLE_ADMIN', $roles, true)) {
                return $this->redirectToRoute('admin');
            }

            return $this->redirectToRoute('app_dashboard');
        }

        return $this->render('user/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
