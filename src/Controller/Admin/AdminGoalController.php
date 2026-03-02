<?php

namespace App\Controller\Admin;

use App\Entity\Objectif;
use App\Repository\ObjectifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/goals')]
class AdminGoalController extends AbstractController
{
    /**
     * Liste paginée de tous les objectifs avec recherche, tri et filtres.
     */
    #[Route('', name: 'app_admin_goals', methods: ['GET'])]
    public function index(
        Request $request,
        ObjectifRepository $objectifRepository,
        PaginatorInterface $paginator
    ): Response {
        $search   = $request->query->get('q');
        $category = $request->query->get('category', 'all');
        $statut   = $request->query->get('statut', 'all');
        $sort     = $request->query->get('sort', 'date_fin');
        $order    = strtolower($request->query->get('order', 'asc')) === 'desc' ? 'desc' : 'asc';

        $query = $objectifRepository->getAdminSearchQuery($search, $category, $statut, $sort, $order);

        $objectifs = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        // Statistiques calculées côté serveur via QueryBuilder
        $stats = $objectifRepository->getAdminStats();

        return $this->render('admin/goals/index.html.twig', [
            'objectifs'        => $objectifs,
            'stats'            => $stats,
            'search'           => $search,
            'current_category' => $category,
            'current_statut'   => $statut,
            'sort'             => $sort,
            'order'            => $order,
        ]);
    }

    /**
     * Suppression d'un objectif via formulaire POST avec token CSRF.
     */
    #[Route('/{id}/delete', name: 'app_admin_goal_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Objectif $objectif,
        EntityManagerInterface $em
    ): Response {
        if ($this->isCsrfTokenValid('admin_delete_goal_' . $objectif->getId(), $request->request->get('_token'))) {
            $em->remove($objectif);
            $em->flush();
            $this->addFlash('success', sprintf('L\'objectif "%s" a été supprimé.', $objectif->getTitre()));
        } else {
            $this->addFlash('error', 'Token de sécurité invalide. Suppression annulée.');
        }

        // Redirige en conservant les filtres actifs
        return $this->redirect(
            $request->headers->get('referer') ?? $this->generateUrl('app_admin_goals')
        );
    }
}
