<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HealthChatbotService
{
    private HttpClientInterface $client;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $openaiApiKey)
    {
        $this->client = $client;
        $this->apiKey = $openaiApiKey;
    }

    public function ask(array $userData, string $question): string
    {
        $systemPrompt = "
Tu es LifeOps AI, un assistant de santé intelligent et attentionné. 

Ton rôle est d'analyser les données de l'utilisateur et de répondre à TOUTES ses questions concernant sa santé, sa forme physique, son bien-être mental, sa nutrition et son hygiène de vie.

Tu dois :
- Utiliser les données fournies pour personnaliser tes réponses.
- Être encourageant et empathique.
- Donner des conseils concrets, actionnables et variés.
- Répondre de manière détaillée si la question le demande.
- Rappeler poliment que tu n'es pas un médecin si la question touche à un diagnostic grave ou une prescription médicale, mais essayer tout de même d'aider sur le plan du bien-être général.

N'hésite pas à aborder tous les sujets de santé (sommeil, stress, sport, alimentation, hydratation, routine matinale, etc.).
";

        $userPrompt = "
Données utilisateur (moyennes récentes et dernier bilan) :
" . json_encode($userData) . "

Question de l'utilisateur :
" . $question;

        if (empty($this->apiKey) || str_contains($this->apiKey, 'placeholder')) {
            $sleep = $userData['moyennes_hebdo']['heuresSommeil'] ?? '?';
            $stress = $userData['dernier_bilan']['niveau_stress'] ?? '?';
            
            return "🚀 **MODE DÉMONSTRATION ACTIVÉ** 🚀\n\n" .
                   "Désolé, je ne peux pas encore répondre dynamiquement à votre question : *\"{$question}\"* car **aucune clé API Gemini n'est configurée**.\n\n" .
                   "**Ce que je peux vous dire selon vos données actuelles :**\n" .
                   "- Votre sommeil moyen est de **{$sleep}h**. " . ($sleep < 7 ? "C'est un peu faible, essayez de gagner 1h." : "Excellent rythme !") . "\n" .
                   "- Votre niveau de stress est de **{$stress}/10**.\n\n" .
                   "🤖 *Pour débloquer la discussion réelle, remplacez la clé par votre clé API Gemini dans le fichier .env.*";
        }

        try {
            // Updated to gemini-2.5-flash-lite (highest rate limits in 2026)
            $response = $this->client->request('POST', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=' . $this->apiKey, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $systemPrompt . "\n\n" . $userPrompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 1000,
                    ]
                ]
            ]);

            $result = $response->toArray();
            return $result['candidates'][0]['content']['parts'][0]['text'] ?? "Désolé, j'ai reçu une réponse vide de Gemini.";
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), '401') || str_contains($e->getMessage(), '403')) {
                return "❌ **Clé API Gemini Invalide** : La clé fournie dans le fichier `.env` semble incorrecte ou n'a pas les droits nécessaires.";
            }
            
            return "Désolé, je rencontre une difficulté technique pour accéder à Gemini. Détails : " . $e->getMessage();
        }
    }
}
