<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
<<<<<<< HEAD
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;
=======
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UtilisateurRepository;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
>>>>>>> ebaffe1c (first commit)

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(
<<<<<<< HEAD
        UtilisateurRepository $userRepo
    ): Response {
        return $this->render('admin/dashboard/index.html.twig', [
            'total_users' => $userRepo->count([]),
            'admin_users' => $userRepo->count(['role' => 'ROLE_ADMIN']),
        ]);
    }
=======
        Request $request,
        UtilisateurRepository $userRepo
    ): Response {
        $search = $request->query->get('q');
        $minAge = $request->query->get('minAge');
        $maxAge = $request->query->get('maxAge');
        $sort = $request->query->get('sort', 'created');
        $order = strtolower($request->query->get('order', 'desc')) === 'asc' ? 'asc' : 'desc';

        $users = $userRepo->findByFilters($search, $sort, $order, $minAge, $maxAge);

        $totalUsers = $userRepo->countTotalUsers(); // Global count
        $adminUsers = $userRepo->countAdmins(); // Global admin count
        $filteredCount = count($users); // Count of currently displayed result

        return $this->render('admin/dashboard/index.html.twig', [
            'users' => $users,
            'total_users' => $totalUsers,
            'admin_users' => $adminUsers,
            'filtered_count' => $filteredCount,
            'search' => $search,
            'minAge' => $minAge,
            'maxAge' => $maxAge,
            'sort' => $sort,
            'order' => $order,
        ]);
    }

    #[Route('/admin/users/{id}/delete', name: 'app_admin_delete_user', methods: ['POST'])]
    public function deleteUser(
        Utilisateur $user,
        EntityManagerInterface $em
    ): JsonResponse {
        // Prevent deleting the last admin
        $adminCount = count(array_filter($em->getRepository(Utilisateur::class)->findAll(), 
            fn($u) => in_array('ROLE_ADMIN', $u->getRoles())));
        
        if (in_array('ROLE_ADMIN', $user->getRoles()) && $adminCount <= 1) {
            return new JsonResponse(['error' => 'Cannot delete the last admin'], 400);
        }

        $em->remove($user);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/admin/users/{id}/ban', name: 'app_admin_ban_user', methods: ['POST'])]
    public function banUser(
        Utilisateur $user,
        EntityManagerInterface $em,
        Request $request
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $days = $data['days'] ?? 30;

        $banUntil = new \DateTime();
        $banUntil->modify("+{$days} days");
        
        $user->setBanUntil($banUntil);
        $em->flush();

        return new JsonResponse(['success' => true, 'message' => "Utilisateur banni jusqu'au " . $banUntil->format('Y-m-d')]);
    }

    #[Route('/admin/users/{id}/unban', name: 'app_admin_unban_user', methods: ['POST'])]
    public function unbanUser(
        Utilisateur $user,
        EntityManagerInterface $em
    ): JsonResponse {
        $user->setBanUntil(null);
        $em->flush();

        return new JsonResponse(['success' => true, 'message' => 'Utilisateur débanni']);
    }
>>>>>>> ebaffe1c (first commit)
}
