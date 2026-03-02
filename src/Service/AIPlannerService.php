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
        private string $apiKey,
        private HttpClientInterface $httpClient,
        private EntityManagerInterface $entityManager
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function optimizePlanning(string $userRequest, \DateTime $startDate, \DateTime $endDate, int $userId): array
    {
        // 1. Collect current data
        $plannings = $this->planningRepo->findByUserAndPeriod($userId, $startDate, $endDate);
        $currentData = $this->formatCurrentPlanning($plannings);

        // 2. Build Prompt
        $prompt = $this->buildPrompt($userRequest, $currentData);

        // 3. Send request to Gemini with retry logic
        $maxRetries = 3;
        $retryDelay = 5; // seconds
        
        for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
            try {
                // Using gemini-flash-latest as it has available quota
                $response = $this->httpClient->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=' . $this->apiKey, [
                    'json' => [
                        'contents' => [
                            ['parts' => [['text' => $prompt]]]
                        ],
                        'generationConfig' => [
                            'responseMimeType' => 'application/json',
                        ]
                    ],
                    'timeout' => 30
                ]);

                $data = $response->toArray(false);

                // Check for API-level errors
                if (isset($data['error'])) {
                    $apiError = $data['error']['message'] ?? 'Erreur API inconnue';
                    if (str_contains($apiError, 'quota') || str_contains($apiError, '429')) {
                        throw new \Exception("Quota dépassé (429) : " . $apiError);
                    }
                    throw new \Exception($apiError);
                }

                // Extract text from Gemini response structure
                $content = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                if ($content === null) {
                    return [
                        'error' => 'Format de réponse IA invalide.',
                        'suggestions' => [],
                        'summary' => 'L\'IA n\'a pas renvoyé de contenu exploitable.'
                    ];
                }

                // Clean potential markdown fencing
                $content = trim($content);
                if (str_starts_with($content, '```')) {
                    $content = preg_replace('/^```(?:json)?\s*/i', '', $content);
                    $content = preg_replace('/\s*```\s*$/', '', $content);
                }

                // 4. Parse response
                $parsed = json_decode($content, true);
                if ($parsed === null && json_last_error() !== JSON_ERROR_NONE) {
                    return [
                        'error' => 'Réponse IA non-JSON : ' . json_last_error_msg(),
                        'suggestions' => [],
                        'summary' => 'L\'IA a renvoyé une réponse illisible.'
                    ];
                }

                return $parsed;

            } catch (\Exception $e) {
                $message = $e->getMessage();
                
                // If it's a 429 and we have retries left, wait and try again
                if ((str_contains($message, '429') || str_contains($message, 'quota')) && $attempt < $maxRetries) {
                    sleep($retryDelay);
                    $retryDelay *= 2; // Exponential backoff
                    continue;
                }

                if (str_contains($message, '429') || str_contains($message, 'quota')) {
                    $message = "Quota épuisé. Le plan gratuit Gemini est limité. Veuillez attendre 60 secondes ou utiliser une nouvelle clé API.";
                }
                
                return [
                    'error' => 'Erreur communication IA : ' . $message,
                    'suggestions' => [],
                    'summary' => 'Impossible de générer des suggestions pour le moment.'
                ];
            }
        }

        return [
            'error' => 'Nombre maximum de tentatives atteint.',
            'suggestions' => [],
            'summary' => 'Impossible de générer des suggestions après plusieurs tentatives.'
        ];
    }

    /**
     * @param array<Planning> $plannings
     */
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
                $data .= "  - Activity: {$activite->getTitre()} (Category: {$activite->getCategorie()}, Priority: {$priority}, Urgency: {$activite->getNiveauUrgence()})\n";
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
6. FIXED CATEGORIES: You MUST use ONLY one of the following categories for "category": Travail, Personnel, Urgent, Loisir, Santé.
7. FIXED COLORS: You MUST use ONLY one of the following HEX colors: #10b981 (Emeraude), #3b82f6 (Bleu), #f59e0b (Orange), #ec4899 (Rose), #8b5cf6 (Violet).
8. URGENCY: Use only "faible", "moyen", or "eleve".
9. BREAKS: For breaks (free_slots), use category "Repos" and color "#9ca3af".

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
                {"start": "H:i", "end": "H:i", "recommendation": "e.g. Pause, Sport, etc."}
            ]
        }
    ],
    "summary": "Analytic summary of the optimization and advice for the user."
}
PROMPT;
    }

    /**
     * @param array<mixed> $suggestions
     */
    public function saveConfirmedSuggestions(array $suggestions, \App\Entity\Utilisateur $user): void
    {
        foreach ($suggestions as $daySuggestion) {
            $rawDate = $daySuggestion['date'] ?? null;
            if (!$rawDate) {
                continue;
            }
            
            try {
                $date = new \DateTime($rawDate);
                $date->setTime(0, 0, 0);
            } catch (\Exception $e) {
                continue;
            }
            
            // Find or create Planning for this day
            $planning = $this->planningRepo->findOneBy(['date' => $date, 'utilisateur' => $user]);
            
            if (!$planning) {
                $planning = new Planning();
                $planning->setDate($date);
                $planning->setUtilisateur($user);
                $planning->setHeureDebutJournee((clone $date)->setTime(8, 0));
                $planning->setHeureFinJournee((clone $date)->setTime(18, 0));
                $planning->setDisponibilite(true);
                $this->entityManager->persist($planning);
            }

            // Handle new activities
            $newActivities = $daySuggestion['new_activities'] ?? $daySuggestion['newActivities'] ?? null;
            if ($newActivities && is_array($newActivities)) {
                foreach ($newActivities as $actData) {
                    $title = $actData['title'] ?? $actData['titre'] ?? 'Activité IA';
                    $startTime = $actData['start'] ?? $actData['debut'] ?? null;
                    $endTime = $actData['end'] ?? $actData['fin'] ?? null;

                    if (!$startTime || !$endTime) {
                        continue;
                    }

                    $activite = new Activite();
                    $activite->setTitre($title);
                    
                    try {
                        $start = new \DateTime($startTime);
                        $end = new \DateTime($endTime);
                        $start->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        $end->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        
                        $activite->setHeureDebutEstimee($start);
                        $activite->setHeureFinEstimee($end);
                    } catch (\Exception $e) {
                        continue;
                    }

                    $activite->setPriorite((int)($actData['priority'] ?? $actData['priorite'] ?? 2));
                    $activite->setNiveauUrgence((string)($actData['urgency'] ?? $actData['urgence'] ?? 'moyen'));
                    $activite->setCategorie($actData['category'] ?? $actData['categorie'] ?? 'IA Suggestion');
                    $activite->setCouleur($actData['color'] ?? $actData['couleur'] ?? '#4f46e5');
                    
                    $interval = $start->diff($end);
                    $minutes = ($interval->h * 60) + $interval->i;
                    $activite->setDuree($minutes > 0 ? $minutes : 30);
                    $activite->setSuggestedByAi(true);

                    $planning->addActivite($activite);
                    $this->entityManager->persist($activite);
                }
            }

            // Handle free slots as activities (Breaks/Pauses)
            $freeSlots = $daySuggestion['free_slots'] ?? $daySuggestion['freeSlots'] ?? null;
            if ($freeSlots && is_array($freeSlots)) {
                foreach ($freeSlots as $slotData) {
                    $title = $slotData['recommendation'] ?? $slotData['reccomendation'] ?? $slotData['title'] ?? 'Pause suggérée';
                    $startTime = $slotData['start'] ?? null;
                    $endTime = $slotData['end'] ?? null;

                    if (!$startTime || !$endTime) continue;

                    $activite = new Activite();
                    $activite->setTitre($title);
                    
                    try {
                        $start = new \DateTime($startTime);
                        $end = new \DateTime($endTime);
                        $start->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        $end->setDate((int)$date->format('Y'), (int)$date->format('m'), (int)$date->format('d'));
                        
                        $activite->setHeureDebutEstimee($start);
                        $activite->setHeureFinEstimee($end);
                    } catch (\Exception $e) { continue; }

                    $activite->setPriorite(1);
                    $activite->setNiveauUrgence('faible');
                    $activite->setCategorie('Repos');
                    $activite->setCouleur('#9ca3af');
                    
                    $interval = $start->diff($end);
                    $minutes = ($interval->h * 60) + $interval->i;
                    $activite->setDuree($minutes > 0 ? $minutes : 30);
                    $activite->setSuggestedByAi(true);

                    $planning->addActivite($activite);
                    $this->entityManager->persist($activite);
                }
            }

            // Handle modifications
            $modifications = $daySuggestion['modifications'] ?? null;
            if ($modifications && is_array($modifications)) {
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
                                $existingActivity->setSuggestedByAi(true);
                            } catch (\Exception $e) {
                                // Skip this modification on error
                            }
                            break;
                        }
                    }
                }
            }
        }

        $this->entityManager->flush();
    }
}
