<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class AiService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $openaiApiKey)
    {
        $this->client = $client;
        $this->apiKey = $openaiApiKey;
    }

    /**
     * Analyse les données de santé pour évaluer le risque de burnout.
     * 
     * @param array $weeklyData Tableau des suivis quotidiens
     * @return array|null Les données analysées ou null en cas d'erreur
     */
    public function analyseBurnout(array $weeklyData): ?array
    {
        if (empty($weeklyData)) {
            return null;
        }

        $prompt = "
Tu es un expert en bien-être et prévention du burnout.

Analyse les données hebdomadaires suivantes issues de suivis quotidiens :
" . json_encode($weeklyData, JSON_PRETTY_PRINT) . "

Objectif :
1. Evaluer le risque de burnout (Faible, Moyen ou Elevé)
2. Donner une courte explication basée sur les tendances observées (sommeil, humeur, activité)
3. Proposer 3 conseils personnalisés pour améliorer l'état de l'utilisateur
4. Estimer des scores globaux (1-10) pour la Fatigue, le Stress et la Forme physique.

Retourne UNIQUEMENT un JSON sous cette forme exacte :

{
  \"risque_burnout\": \"Faible | Moyen | Elevé\",
  \"score_fatigue\": 5,
  \"score_stress\": 5,
  \"score_forme\": 5,
  \"explication\": \"votre texte ici\",
  \"conseils\": [\"conseil 1\", \"conseil 2\", \"conseil 3\"]
}
";

        try {
            // Migrated AiService to Google Gemini
            $response = $this->client->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=' . $this->apiKey, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt . "\n\nRéponds UNIQUEMENT par le JSON demandé."]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.2,
                        'response_mime_type' => 'application/json',
                    ]
                ]
            ]);

            $content = $response->toArray();
            $textResponse = $content['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
            $data = json_decode($textResponse, true);

            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Chat général avec l'IA.
     */
    public function chat(string $userMessage, array $context = []): ?string
    {
        try {
            $response = $this->client->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=' . $this->apiKey, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Tu es LifeOps AI, un assistant intelligent spécialisé dans le bien-être, la productivité et la gestion personnelle. Aide l'utilisateur de manière concise et encourageante.\n\n" . 
                                         (!empty($context) ? "Contexte : " . json_encode($context) . "\n\n" : "") .
                                         "Utilisateur : " . $userMessage]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1000,
                    ]
                ]
            ]);

            $content = $response->toArray();
            return $content['candidates'][0]['content']['parts'][0]['text'] ?? "Désolé, j'ai reçu une réponse vide.";
        } catch (\Exception $e) {
            return "Désolé, je rencontre une petite difficulté technique pour vous répondre. Réessayez dans un instant !";
        }
    }
}
