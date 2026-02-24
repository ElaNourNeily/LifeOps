<?php

namespace App\Service;

use App\Repository\PlanningRepository;
use App\Repository\ActiviteRepository;
use App\Entity\Planning;
use App\Entity\Activite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AIPlannerService
{
    public function __construct(
        private PlanningRepository $planningRepo,
        private ActiviteRepository $activiteRepo,
        private string $apiKey,
        private HttpClientInterface $httpClient,
        private EntityManagerInterface $entityManager
    ) {}

    public function optimizePlanning(string $userRequest, \DateTime $startDate, \DateTime $endDate, $userId): array
    {
        // 1. Collect current data
        $plannings = $this->planningRepo->findByUserAndPeriod($userId, $startDate, $endDate);
        $currentData = $this->formatCurrentPlanning($plannings);

        // 2. Build Prompt
        $prompt = $this->buildPrompt($userRequest, $currentData);

        // 3. Send request to Gemini with retry logic
        $maxRetries = 2;
        $retryDelay = 2; // seconds
        
        for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
            try {
                $response = $this->httpClient->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . $this->apiKey, [
                    'json' => [
                        'contents' => [
                            ['parts' => [['text' => $prompt]]]
                        ],
                        'generationConfig' => [
                            'response_mime_type' => 'application/json',
                        ]
                    ]
                ]);

                $data = $response->toArray();
                $content = $data['candidates'][0]['parts'][0]['text'] ?? $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                
                // 4. Parse response
                return json_decode($content, true) ?: [
                    'error' => 'Format de réponse IA invalide.',
                    'suggestions' => [],
                    'summary' => 'L\'IA a renvoyé une réponse illisible.'
                ];

            } catch (\Exception $e) {
                $message = $e->getMessage();
                
                // If it's a 429 and we have retries left, wait and try again
                if (str_contains($message, '429') && $attempt < $maxRetries) {
                    sleep($retryDelay);
                    $retryDelay *= 2; // Exponential backoff
                    continue;
                }

                if (str_contains($message, '429')) {
                    $message = "Quota épuisé (429). Veuillez attendre 60 secondes avant de réessayer ou utilisez une autre clé API.";
                }
                
                return [
                    'error' => 'Erreur lors de la communication avec l\'IA Gemini : ' . $message,
                    'suggestions' => [],
                    'summary' => 'Impossible de générer des suggestions pour le moment.'
                ];
            }
        }
    }

    private function formatCurrentPlanning(array $plannings): string
    {
        if (empty($plannings)) {
            return "No activities scheduled for this period.";
        }

        $data = "Current week plannings:\n";
        foreach ($plannings as $planning) {
            $data .= "- Date: {$planning->getDate()->format('Y-m-d')}\n";
            $data .= "  Hours: {$planning->getHeureDebutJournee()->format('H:i')} to {$planning->getHeureFinJournee()->format('H:i')}\n";
            foreach ($planning->getActivites() as $activite) {
                $priority = match($activite->getPriorite()) {
                    1 => 'Basse',
                    2 => 'Moyenne',
                    3 => 'Haute',
                    default => 'Inconnue'
                };
                $data .= "  - Activity: {$activite->getTitre()} (Category: {$activite->getCategorie()}, Priority: {$priority}, Urgency: {$activite->getNiveauUrgence()}/10)\n";
                $data .= "    Time: {$activite->getHeureDebutEstimee()->format('H:i')} - {$activite->getHeureFinEstimee()->format('H:i')}\n";
            }
        }
        return $data;
    }

    private function buildPrompt(string $userRequest, string $currentData): string
    {
        return <<<PROMPT
User request: {$userRequest}

{$currentData}

Optimize the planning based on the user request.
CRITICAL RULES:
1. NO OVERLAPS: Ensure no two activities (new, modified, or free slots) overlap in time. Each time slot must be exclusive.
2. RESPECT EXISTING: If an activity exists and isn't modified, do not schedule something over it.
3. RESOLVE CONFLICTS: If a new activity or modification conflicts with an existing one, you MUST move one of them or suggest a modification to resolve the conflict.
4. Suggest reordered activities and prioritize high urgency/priority tasks.
5. Ensure suggested times respect the planning's daily start and end hours.
6. FIXED CATEGORIES: You MUST use ONLY one of the following categories for "category": Travail, Personnel, Urgent, Loisir, Santé, Repos.
7. FIXED COLORS: You MUST use ONLY one of the following HEX colors: #10b981 (Emerald), #3b82f6 (Blue), #f59e0b (Orange), #ec4899 (Pink), #8b5cf6 (Purple), #9ca3af (Gray for Repos).
8. URGENCY: Use only "faible", "moyen", or "eleve".

Respond strictly as JSON with the following structure:
{
    "suggestions": [
        {
            "date": "Y-m-d",
            "new_activities": [
                {
                    "title": "...",
                    "start": "H:i",
                    "end": "H:i",
                    "priority": 1-3,
                    "urgency": 1-10,
                    "category": "...",
                    "color": "#hex",
                    "reason": "Why this was suggested or moved"
                }
            ],
            "modifications": [
                {
                    "original_title": "...",
                    "new_start": "H:i",
                    "new_end": "H:i",
                    "reason": "..."
                }
            ],
            "free_slots": [
                {"start": "H:i", "end": "H:i", "reccomendation": "e.g. Pause, Sport, etc."}
            ]
        }
    ],
    "summary": "Analytic summary of the optimization and advice for the user."
}
PROMPT;
    }

    public function saveConfirmedSuggestions(array $suggestions, $user): void
    {
        $logFile = 'ai_persistence.log';
        file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Starting persistence for user " . $user->getId() . "\n", FILE_APPEND);
        
        foreach ($suggestions as $daySuggestion) {
            $rawDate = $daySuggestion['date'] ?? null;
            if (!$rawDate) {
                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Skip day: no date provided\n", FILE_APPEND);
                continue;
            }

            file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Processing day: $rawDate\n", FILE_APPEND);
            
            try {
                $date = new \DateTime($rawDate);
                $date->setTime(0, 0, 0);
            } catch (\Exception $e) {
                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Invalid date format: $rawDate\n", FILE_APPEND);
                continue;
            }
            
            // Find or create Planning for this day
            $planning = $this->planningRepo->findOneBy(['date' => $date, 'utilisateur' => $user]);
            
            if (!$planning) {
                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Creating new planning for date " . $date->format('Y-m-d') . "\n", FILE_APPEND);
                $planning = new \App\Entity\Planning();
                $planning->setDate($date);
                $planning->setUtilisateur($user);
                $planning->setHeureDebutJournee((clone $date)->setTime(8, 0));
                $planning->setHeureFinJournee((clone $date)->setTime(18, 0));
                $planning->setDisponibilite(true);
                $this->entityManager->persist($planning);
            }

            // Flexible key check for new activities (support snake_case and camelCase)
            $newActivities = $daySuggestion['new_activities'] ?? $daySuggestion['newActivities'] ?? null;
            if ($newActivities && is_array($newActivities)) {
                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Found " . count($newActivities) . " new activities\n", FILE_APPEND);
                foreach ($newActivities as $actData) {
                    $title = $actData['title'] ?? $actData['titre'] ?? 'Activite IA';
                    $startTime = $actData['start'] ?? $actData['debut'] ?? null;
                    $endTime = $actData['end'] ?? $actData['fin'] ?? null;

                    if (!$startTime || !$endTime) {
                        file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Skip activity $title: missing times\n", FILE_APPEND);
                        continue;
                    }

                    $activite = new \App\Entity\Activite();
                    $activite->setTitre($title);
                    
                    try {
                        $start = new \DateTime($startTime);
                        $end = new \DateTime($endTime);
                        // Normalize to planning date
                        $start->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        $end->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        
                        $activite->setHeureDebutEstimee($start);
                        $activite->setHeureFinEstimee($end);
                    } catch (\Exception $e) {
                         file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Error parsing times for $title: $startTime - $endTime\n", FILE_APPEND);
                         continue;
                    }

                    $activite->setPriorite((int)($actData['priority'] ?? $actData['priorite'] ?? 2));
                    $activite->setNiveauUrgence((string)($actData['urgency'] ?? $actData['urgence'] ?? 'moyen'));
                    $activite->setCategorie($actData['category'] ?? $actData['categorie'] ?? 'IA Suggestion');
                    $activite->setCouleur($actData['color'] ?? $actData['couleur'] ?? '#4f46e5');
                    
                    // Calculate duration in minutes
                    $interval = $start->diff($end);
                    $minutes = ($interval->h * 60) + $interval->i;
                    $activite->setDuree($minutes > 0 ? $minutes : 30);

                    $planning->addActivite($activite);
                    $this->entityManager->persist($activite);
                    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Persisted activity: $title\n", FILE_APPEND);
                }
            }

            // Handle free slots as suggestions (Breaks/Pauses)
            $freeSlots = $daySuggestion['free_slots'] ?? $daySuggestion['freeSlots'] ?? null;
            if ($freeSlots && is_array($freeSlots)) {
                 file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Found " . count($freeSlots) . " free slots to possibly persist\n", FILE_APPEND);
                 foreach ($freeSlots as $slotData) {
                    $title = $slotData['recommendation'] ?? $slotData['reccomendation'] ?? $slotData['title'] ?? 'Pause suggérée';
                    $startTime = $slotData['start'] ?? null;
                    $endTime = $slotData['end'] ?? null;

                    if (!$startTime || !$endTime) continue;

                    $activite = new \App\Entity\Activite();
                    $activite->setTitre($title);
                    
                    try {
                        $start = new \DateTime($startTime);
                        $end = new \DateTime($endTime);
                        $start->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        $end->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        
                        $activite->setHeureDebutEstimee($start);
                        $activite->setHeureFinEstimee($end);
                    } catch (\Exception $e) { continue; }

                    $activite->setPriorite(1); // Low priority for breaks
                    $activite->setNiveauUrgence('faible');
                    $activite->setCategorie('Repos');
                    $activite->setCouleur('#9ca3af'); // Gray
                    
                    $interval = $start->diff($end);
                    $minutes = ($interval->h * 60) + $interval->i;
                    $activite->setDuree($minutes > 0 ? $minutes : 30);

                    $planning->addActivite($activite);
                    $this->entityManager->persist($activite);
                    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Persisted free slot as activity: $title\n", FILE_APPEND);
                 }
            }

            // Flexible key check for modifications
            $modifications = $daySuggestion['modifications'] ?? $daySuggestion['mods'] ?? null;
            if ($modifications && is_array($modifications)) {
                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Found " . count($modifications) . " modifications\n", FILE_APPEND);
                foreach ($modifications as $modData) {
                    $origTitle = $modData['original_title'] ?? $modData['originalTitle'] ?? null;
                    $newStartStr = $modData['new_start'] ?? $modData['newStart'] ?? null;
                    $newEndStr = $modData['new_end'] ?? $modData['newEnd'] ?? null;

                    if (!$origTitle || !$newStartStr || !$newEndStr) continue;

                    foreach ($planning->getActivites() as $existingActivity) {
                        if (trim(strtolower($existingActivity->getTitre())) === trim(strtolower($origTitle))) {
                            try {
                                $newStart = new \DateTime($newStartStr);
                                $newEnd = new \DateTime($newEndStr);
                                
                                $newStart->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                                $newEnd->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                                
                                $existingActivity->setHeureDebutEstimee($newStart);
                                $existingActivity->setHeureFinEstimee($newEnd);
                                
                                $interval = $newStart->diff($newEnd);
                                $minutes = ($interval->h * 60) + $interval->i;
                                $existingActivity->setDuree($minutes > 0 ? $minutes : $existingActivity->getDuree());
                                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Updated activity: $origTitle\n", FILE_APPEND);
                            } catch (\Exception $e) {
                                file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Error updating $origTitle: " . $e->getMessage() . "\n", FILE_APPEND);
                            }
                            break;
                        }
                    }
                }
            }
        }

        $this->entityManager->flush();
        file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] Persistence complete (flush)\n", FILE_APPEND);
    }
}
