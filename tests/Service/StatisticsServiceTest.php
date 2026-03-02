<?php

namespace App\Tests\Service;

use App\Entity\Activite;
use App\Entity\Planning;
use App\Repository\ActiviteRepository;
use App\Service\StatisticsService;
use PHPUnit\Framework\TestCase;

class StatisticsServiceTest extends TestCase
{
    private $activiteRepository;
    private $service;

    protected function setUp(): void
    {
        $this->activiteRepository = $this->createMock(ActiviteRepository::class);
        $this->service = new StatisticsService($this->activiteRepository);
    }

    public function testGetCompletionRateReturnsZeroWhenNoActivities(): void
    {
        $user = $this->createMock(\App\Entity\Utilisateur::class);
        $this->activiteRepository->method('findByUser')->willReturn([]);
        $this->assertEquals(0, $this->service->getCompletionRate($user));
    }

    public function testGetCompletionRateCalculatesCorrectly(): void
    {
        $user = $this->createMock(\App\Entity\Utilisateur::class);
        $act1 = $this->createMock(Activite::class);
        $act1->method('getStatutDynamique')->willReturn('Terminé');
        
        $act2 = $this->createMock(Activite::class);
        $act2->method('getStatutDynamique')->willReturn('En attente');

        $this->activiteRepository->method('findByUser')->willReturn([$act1, $act2]);

        $this->assertEquals(50, $this->service->getCompletionRate($user));
    }

    public function testGetPriorityDistribution(): void
    {
        $user = $this->createMock(\App\Entity\Utilisateur::class);
        $act1 = $this->createMock(Activite::class);
        $act1->method('getPriorite')->willReturn(1); // Basse
        
        $act2 = $this->createMock(Activite::class);
        $act2->method('getPriorite')->willReturn(3); // Haute

        $this->activiteRepository->method('findByUser')->willReturn([$act1, $act2]);

        $expected = [
            'Basse' => 1,
            'Moyenne' => 0,
            'Haute' => 1
        ];

        $this->assertEquals($expected, $this->service->getPriorityDistribution($user));
    }

    public function testGetWeeklyWorkedMinutes(): void
    {
        $user = $this->createMock(\App\Entity\Utilisateur::class);
        $planning = $this->createMock(Planning::class);
        $planning->method('getDate')->willReturn(new \DateTime('2026-03-02')); // Week 10
        
        $act = $this->createMock(Activite::class);
        $act->method('getStatutDynamique')->willReturn('Terminé');
        $act->method('getPlanning')->willReturn($planning);
        $act->method('getDuree')->willReturn(120);

        $this->activiteRepository->method('findByUser')->willReturn([$act]);

        $result = $this->service->getWeeklyWorkedMinutes($user);

        $this->assertArrayHasKey('2026-W10', $result);
        $this->assertEquals(120, $result['2026-W10']);
    }
}
