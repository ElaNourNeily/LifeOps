<?php

namespace App\Service;

use App\Repository\ActiviteRepository;

class StatisticsService
{
    public function __construct(
        private ActiviteRepository $activiteRepository
    ) {}

    public function getWeeklyWorkedMinutes($user): array
    {
        $activities = $this->activiteRepository->findByUser($user);

        $weeks = [];

        foreach ($activities as $activity) {
            if ($activity->getStatutDynamique() !== 'Terminé') {
                continue;
            }

            $date = $activity->getPlanning()->getDate();
            if (!$date) continue;
            
            $week = $date->format('o-\WW');

            if (!isset($weeks[$week])) {
                $weeks[$week] = 0;
            }

            $weeks[$week] += $activity->getDuree();
        }

        // Sort by week key
        ksort($weeks);

        return $weeks;
    }

    public function getCompletionRate($user): float
    {
        $activities = $this->activiteRepository->findByUser($user);

        if (count($activities) === 0) {
            return 0;
        }

        $completed = array_filter($activities, fn($a) => $a->getStatutDynamique() === 'Terminé');

        return (count($completed) / count($activities)) * 100;
    }

    public function getPriorityDistribution($user): array
    {
        $activities = $this->activiteRepository->findByUser($user);

        $priorities = [
            'Basse' => 0,
            'Moyenne' => 0,
            'Haute' => 0
        ];

        foreach ($activities as $activity) {
            $p = $activity->getPriorite();
            if ($p == 1) $priorities['Basse']++;
            elseif ($p == 2) $priorities['Moyenne']++;
            elseif ($p == 3) $priorities['Haute']++;
        }

        return $priorities;
    }
}
