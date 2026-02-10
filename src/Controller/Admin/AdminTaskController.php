<?php

namespace App\Controller\Admin;

use App\Repository\TacheRepository;
use App\Repository\TaskSpaceRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/taches')]
class AdminTaskController extends AbstractController
{
    #[Route('', name: 'app_admin_taches')]
    public function index(TacheRepository $taskRepo, TaskSpaceRepository $spaceRepo, UtilisateurRepository $userRepo): Response
    {
        $taskStats = $taskRepo->getGlobalStats();
        $spaceStats = $spaceRepo->getTaskSpaceStats();
        $activityTrends = $taskRepo->getActivityTrends();
        $avgDuration = $taskRepo->getAverageDuration();

        // Workload Indicator
        $totalUsers = $userRepo->count([]);
        $workload = $totalUsers > 0 ? $taskStats['total'] / $totalUsers : 0;

        // Calculate rates
        $totalTasks = $taskStats['total'];
        $completedPercent = $totalTasks > 0 ? ($taskStats['completed'] / $totalTasks) * 100 : 0;
        $overduePercent = ($totalTasks - $taskStats['completed']) > 0 
            ? ($taskStats['overdue'] / ($totalTasks - $taskStats['completed'])) * 100 
            : 0;

        // Alerts (Simple Logic)
        $alerts = [];
        if ($overduePercent > 20) {
            $alerts[] = [
                'type' => 'warning',
                'message' => 'Global increase in overdue tasks (>20% of open tasks)'
            ];
        }
        if ($completedPercent < 40 && $totalTasks > 10) {
            $alerts[] = [
                'type' => 'danger',
                'message' => 'Drop in task completion rate (below 40%)'
            ];
        }

        return $this->render('admin/tasks/analytics.html.twig', [
            'stats' => $taskStats,
            'space_stats' => $spaceStats,
            'activity_trends' => $activityTrends,
            'avg_duration' => $avgDuration,
            'completed_percent' => $completedPercent,
            'overdue_percent' => $overduePercent,
            'workload' => $workload,
            'alerts' => $alerts,
        ]);
    }

    #[Route('/export/{format}', name: 'app_admin_tasks_export')]
    public function export(string $format, TacheRepository $taskRepo, TaskSpaceRepository $spaceRepo): Response
    {
        $stats = $taskRepo->getGlobalStats();
        $spaceStats = $spaceRepo->getTaskSpaceStats();

        if ($format === 'csv') {
            $csvData = "Metric,Value\n";
            $csvData .= "Total Tasks," . $stats['total'] . "\n";
            $csvData .= "Completed Tasks," . $stats['completed'] . "\n";
            $csvData .= "Overdue Tasks," . $stats['overdue'] . "\n";
            $csvData .= "Solo TaskSpaces," . $spaceStats['solo'] . "\n";
            $csvData .= "Group TaskSpaces," . $spaceStats['group'] . "\n";
            $csvData .= "Inactive TaskSpaces," . $spaceStats['inactive'] . "\n";

            $response = new Response($csvData);
            $response->headers->set('Content-Type', 'text/csv');
            $response->headers->set('Content-Disposition', 'attachment; filename="global_task_report.csv"');

            return $response;
        }

        return new Response("Export for $format is not yet fully implemented (requires PDF bundle). Please use CSV.");
    }
}
