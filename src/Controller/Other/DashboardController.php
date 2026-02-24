<?php

namespace App\Controller\Other;

use App\Repository\BilanSanteRepository;
use App\Repository\BudgetRepository;
use App\Repository\DepenseRepository;
use App\Repository\ObjectifRepository;
use App\Repository\PlanningRepository;
use App\Repository\TacheRepository;
use App\Repository\TaskSpaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        TacheRepository $tacheRepository,
        DepenseRepository $depenseRepository,
        BudgetRepository $budgetRepository,
        BilanSanteRepository $bilanSanteRepository,
        ObjectifRepository $objectifRepository,
        PlanningRepository $planningRepository,
        TaskSpaceRepository $taskSpaceRepository
    ): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // ════════════════════════════════════════════════════════════════
        // 1. EXISTING DASHBOARD DATA (Tasks, Budget, Objectives, Health)
        // ════════════════════════════════════════════════════════════════
        
        $taches = $tacheRepository->findBy(['utilisateur' => $user], ['deadline' => 'ASC']);
        $depenses = $depenseRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);
        $budgets = $budgetRepository->findBy(['utilisateur' => $user]);
        $bilanSantes = $bilanSanteRepository->findBy(['utilisateur' => $user], ['date_fin' => 'DESC']);
        $objectifs = $objectifRepository->findBy(['utilisateur' => $user], ['date_fin' => 'ASC']);
        $planning = $planningRepository->findBy(['utilisateur' => $user]); // If applicable

        // Task Stats
        $todoTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'todo'));
        $inProgressTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'in-progress'));
        $doneTasks = count(array_filter($taches, fn($t) => $t->getStatut() === 'done'));

        // Expenses Stats
        $currentMonth = date('Y-m');
        $totalDepensesMonth = 0;
        foreach ($depenses as $depense) {
            if ($depense->getDate() && $depense->getDate()->format('Y-m') === $currentMonth) {
                $totalDepensesMonth += $depense->getMontant();
            }
        }
        
        $currentBudget = null;
        $budgetAmount = $budgets[0] ?? null ? $budgets[0]->getRevenuMensuel() : 0; 
        $balance = $budgetAmount - $totalDepensesMonth;

        $latestBilan = $bilanSantes[0] ?? null;
        $activeObjectifs = count(array_filter($objectifs, fn($o) => $o->getStatut() === 'in-progress'));


        // ════════════════════════════════════════════════════════════════
        // 2. NEW COLLABORATIVE DATA (TaskSpaces & Group Tasks)
        // ════════════════════════════════════════════════════════════════

        // A. Projects the user LEADS
        $myProjects = $taskSpaceRepository->findBy(
            ['utilisateur' => $user],
            ['date_creation' => 'DESC']
        );

        // B. Projects where the user is a MEMBER (Assigned to tasks by someone else)
        $tasksInGroups = $tacheRepository->createQueryBuilder('t')
            ->select('t', 'ts')
            ->join('t.taskSpace', 'ts')
            ->where('t.utilisateur = :user')
            ->andWhere('ts.utilisateur != :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();

        $seen = [];
        $memberProjects = [];
        foreach ($tasksInGroups as $task) {
            $ts = $task->getTaskSpace();
            if ($ts && !isset($seen[$ts->getId()])) {
                $seen[$ts->getId()] = true;
                $memberProjects[] = $ts;
            }
        }

        // C. Recent Group Tasks Notifications
        // Assumes you added `findRecentlyAssignedToUser` in TacheRepository
        $recentGroupTasks = $tacheRepository->findRecentlyAssignedToUser($user, 4);


       // ════════════════════════════════════════════════════════════════
        // 3. RENDER TEMPLATE
        // ════════════════════════════════════════════════════════════════

        return $this->render('other/dashboard/index.html.twig', [
            // Standard data
            'taches' => $taches,
            'recentTaches' => array_slice($taches, 0, 5),
            'planning' => $planning,
            'objectifs' => $objectifs,
            'recentObjectifs' => array_slice($objectifs, 0, 3),
            'depenses' => $depenses,
            'recentDepenses' => array_slice($depenses, 0, 5),
            'latestBilan' => $latestBilan,
            'stats' => [
                'todoTasks' => $todoTasks,
                'inProgressTasks' => $inProgressTasks,
                'doneTasks' => $doneTasks,
                'totalDepenses' => $totalDepensesMonth,
                'balance' => $balance,
                'activeObjectifs' => $activeObjectifs,
                'budget' => $budgetAmount, // <--- THIS WAS MISSING
            ],
            
            // Collaborative data (Added for the Widget)
            'myProjects' => $myProjects,
            'memberProjects' => $memberProjects,
            'recentGroupTasks' => $recentGroupTasks,
        ]);
    }
}