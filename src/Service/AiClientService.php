<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Tache;

class AiClientService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function prioritizeTasks(array $taches): array
    {
        $payload = [];

        foreach ($taches as $tache) {
            $payload[] = [
                "id" => $tache->getId(),
                "titre" => $tache->getTitre(),
                "priorite" => $tache->getPriorite(),
                "difficulte" => $tache->getDifficulte(),
                "deadline" => $tache->getDeadline()?->format('Y-m-d'),
                "createdAt" => $tache->getCreatedAt() 
                    ? $tache->getCreatedAt()->format(\DateTimeInterface::ATOM) 
                    : (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM)
            ];
        }

        $response = $this->client->request(
            'POST',
            'http://127.0.0.1:8001/ai/prioritize',
            ['json' => $payload]
        );

        return $response->toArray();
    }

    public function detectOverload(array $taches): array
    {
        $payload = [];

        foreach ($taches as $tache) {
            $payload[] = [
                "id" => $tache->getId(),
                "titre" => $tache->getTitre(),
                "priorite" => $tache->getPriorite(),
                "difficulte" => $tache->getDifficulte(),
                "deadline" => $tache->getDeadline()?->format('Y-m-d'),
                // Safe ATOM format for FastAPI
                "createdAt" => $tache->getCreatedAt() 
                    ? $tache->getCreatedAt()->format(\DateTimeInterface::ATOM) 
                    : (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM)
            ];
        }

        $response = $this->client->request(
            'POST',
            'http://127.0.0.1:8001/ai/overload',
            ['json' => $payload]
        );

        return $response->toArray();
    }
}