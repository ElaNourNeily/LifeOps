<?php

namespace App\Tests\Service;

use App\Entity\Activite;
use App\Entity\Planning;
use App\Repository\ActiviteRepository;
use App\Repository\PlanningRepository;
use App\Service\AIPlannerService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class AIPlannerServiceTest extends TestCase
{
    private $planningRepository;
    private $activiteRepository;
    private $entityManager;
    private $httpClient;
    private $service;

    protected function setUp(): void
    {
        $this->planningRepository = $this->createMock(PlanningRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->service = new AIPlannerService(
            $this->planningRepository,
            'test_key',
            $this->httpClient,
            $this->entityManager
        );
    }

    public function testBuildPromptContainsCriticalRules(): void
    {
        $reflection = new \ReflectionClass(AIPlannerService::class);
        $method = $reflection->getMethod('buildPrompt');
        $method->setAccessible(true);

        $prompt = $method->invoke($this->service, 'Optimise ma semaine', 'Current data');

        $this->assertStringContainsString('NO OVERLAPS', $prompt);
        $this->assertStringContainsString('FIXED CATEGORIES', $prompt);
        $this->assertStringContainsString('FIXED COLORS', $prompt);
        $this->assertStringContainsString('Optimise ma semaine', $prompt);
    }

    public function testOptimizePlanningHandlesInvalidJsonResponse(): void
    {
        $response = $this->createMock(ResponseInterface::class);
        $response->method('toArray')->willReturn([
            'candidates' => [
                ['content' => ['parts' => [['text' => 'invalid json']]]]
            ]
        ]);

        $this->httpClient->method('request')->willReturn($response);

        $startDate = new \DateTime('today');
        $endDate = (clone $startDate)->modify('+3 days');

        $result = $this->service->optimizePlanning('request', $startDate, $endDate, 1);

        $this->assertArrayHasKey('error', $result);
        $this->assertStringContainsString('Réponse IA non-JSON', $result['error']);
    }

    public function testSaveConfirmedSuggestionsSetsSuggestedByAi(): void
    {
        $planning = new Planning();
        $planning->setDate(new \DateTime('today'));
        $this->planningRepository->method('findOneBy')->willReturn($planning);

        $suggestions = [
            [
                'date' => (new \DateTime('today'))->format('Y-m-d'),
                'new_activities' => [
                    [
                        'title' => 'AI Activity',
                        'start' => '10:00',
                        'end' => '11:00',
                        'category' => 'Travail',
                        'priority' => 3
                    ]
                ]
            ]
        ];

        $this->entityManager->expects($this->atLeastOnce())->method('persist');
        $this->entityManager->expects($this->once())->method('flush');

        $user = $this->createMock(\App\Entity\Utilisateur::class);
        $this->service->saveConfirmedSuggestions($suggestions, $user);

        $activities = $planning->getActivites();
        $this->assertCount(1, $activities);
        $this->assertTrue($activities[0]->isSuggestedByAi());
        $this->assertEquals('AI Activity', $activities[0]->getTitre());
    }
}
