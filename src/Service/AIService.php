<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class AIService
{
    private $httpClient;
    private $logger;
    private $apiKey;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger, string $apiKey = null)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->apiKey = $apiKey;
    }

    /**
     * Generates a list of action steps for a given goal title.
     * 
     * @param string $goalTitle
     * @param string $goalDescription
     * @return array List of step titles
     */
    public function suggestSteps(string $goalTitle, string $goalDescription = ''): array
    {
        if (!$this->apiKey || $this->apiKey === 'placeholder') {
            return $this->getMockSteps($goalTitle);
        }

        try {
            // Google Gemini API integration
            $prompt = "En tant qu'assistant de productivité, décompose l'objectif suivant en 5 étapes concrètes, courtes et actionnables. 
                       Objectif : $goalTitle
                       Description : $goalDescription
                       Réponds uniquement avec un tableau JSON de chaînes de caractères (max 5 étapes). 
                       NE FAIS PAS de texte avant ou après le JSON. 
                       Exemple : [\"Étape 1\", \"Étape 2\"]";

            $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $this->apiKey;

            $response = $this->httpClient->request('POST', $url, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = $response->toArray();
                $content = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                
                // Gemini sometimes wraps JSON in markdown blocks
                $content = preg_replace('/```json\n?|\n?```/', '', $content);
                $content = trim($content);
                $steps = json_decode($content, true);
                
                if (is_array($steps)) {
                    return array_slice($steps, 0, 5);
                } else {
                    $this->logger->warning('Gemini JSON decode failed. Raw content: ' . $content);
                }
            } else {
                $this->logger->error('Gemini API returned status ' . $response->getStatusCode() . ': ' . $response->getContent(false));
            }
        } catch (\Exception $e) {
            $this->logger->error('Gemini AI Generation failed: ' . $e->getMessage());
        }

        return $this->getMockSteps($goalTitle);
    }

    /**
     * Fallback mock steps with keyword detection to be more specific.
     */
    private function getMockSteps(string $title): array
    {
        $titleLower = mb_strtolower($title);
        
        // Dictionary of keywords to specific steps
        $presets = [
            'apprendre' => [
                "Choisir le cours ou le livre de référence pour '$title'",
                "Planifier 30 minutes d'étude quotidienne",
                "Pratiquer les concepts de base avec des exercices",
                "Rejoindre une communauté ou un forum sur le sujet",
                "Réaliser un premier projet concret utilisant les acquis"
            ],
            'courir' => [
                "Acheter une paire de chaussures de course adaptée",
                "Télécharger un plan d'entraînement (Couch to 5K, etc.)",
                "Faire une première séance de 15 minutes",
                "Augmenter la distance de 10% chaque semaine",
                "S'inscrire à une course officielle pour rester motivé"
            ],
            'finances' => [
                "Lister toutes les dépenses du mois dernier",
                "Créer un budget avec des enveloppes précises",
                "Ouvrir un compte d'épargne séparé",
                "Automatiser un virement en début de mois",
                "Revoir le budget après 30 jours"
            ],
            'santé' => [
                "Prendre un rendez-vous pour un bilan complet",
                "Remplacer une boisson sucrée par de l'eau quotidiennement",
                "Cuisiner 3 repas équilibrés par semaine",
                "Marcher au moins 15 minutes le matin",
                "Améliorer la qualité du sommeil (écrans coupés à 22h)"
            ],
            'eau' => [
                "Acheter une gourde réutilisable de 1L ou 2L",
                "Remplir la gourde dès le réveil",
                "Utiliser une application de rappel ou des alarmes",
                "Boire un verre d'eau avant chaque repas",
                "Suivre sa consommation quotidienne par écrit"
            ],
            'boire' => [
                "Identifier la quantité cible par jour",
                "Avoir toujours de l'eau à portée de main",
                "Ajouter une tranche de citron ou de menthe si besoin",
                "Prendre une gorgée après chaque tâche terminée",
                "Évaluer son énergie en fin de journée"
            ],
          
           
            'partir' => [
                "Fixer les dates exactes du départ",
                "Créer une checklist pour les bagages",
                "Organiser les transports vers l'aéroport",
                "Prévenir sa banque pour l'utilisation de la carte à l'étranger",
                "Souscrire à une assurance voyage complète"
            ],
            'groupe' => [
                "Identifier les rôles et responsabilités de chaque membre",
                "Mettre en place un outil de communication partagé (Slack, Discord, etc.)",
                "Fixer une première réunion de cadrage (Kick-off)",
                "Définir des objectifs communs et des échéances claires",
                "Établir un calendrier de suivi hebdomadaire"
            ],
            'travail' => [
                "Lister les tâches prioritaires de la semaine",
                "Aménager un espace de travail calme et ergonomique",
                "Utiliser la méthode Pomodoro pour rester concentré",
                "Éviter les distractions (notifications coupées)",
                "Faire un bilan quotidien des accomplissements"
            ],
            'equipe' => [
                "Organiser un moment de team-building informel",
                "Clarifier les attentes mutuelles lors d'un entretien",
                "Utiliser un tableau de bord partagé (Trello, Notion)",
                "Valoriser les succès collectifs régulièrement",
                "Encourager le feedback constructif au sein du groupe"
            ]
        ];

        foreach ($presets as $keyword => $steps) {
            if (str_contains($titleLower, $keyword)) {
                return $steps;
            }
        }

        // Generic but slightly better fallback
        return [
            "Préciser l'objectif : '" . $title . "' doit être mesurable",
            "Identifier les 3 obstacles majeurs à la réussite",
            "Bloquer des créneaux dans l'agenda pour y travailler",
            "Chercher un mentor ou un partenaire de responsabilité",
            "Célébrer la première petite victoire dans 10 jours"
        ];
    }

    /**
     * Analyzes a goal based on SMART criteria.
     */
    public function analyzeGoalSMART(string $title, string $description): array
    {
        if (!$this->apiKey || $this->apiKey === 'placeholder') {
            return [
                'scores' => ['S' => 7, 'M' => 5, 'A' => 8, 'R' => 9, 'T' => 4],
                'advice' => "Ceci est une simulation. Pour une analyse réelle, configurez votre clé API Gemini. Conseil : Ajoutez une date limite précise pour améliorer le score 'Temporel'."
            ];
        }

        try {
            $prompt = "Analyse cet objectif selon les critères SMART (Spécifique, Mesurable, Atteignable, Réaliste, Temporel). 
                       Objectif : $title
                       Description : $description
                       
                       Fournis un score de 1 à 10 pour chaque lettre (S, M, A, R, T) et un court paragraphe de conseils pour l'améliorer.
                       Réponds uniquement avec un JSON au format suivant :
                       {
                         \"scores\": {\"S\": 8, \"M\": 6, \"A\": 9, \"R\": 8, \"T\": 5},
                         \"advice\": \"Ton conseil ici...\"
                       }";

            $url = "https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=" . $this->apiKey;

            $response = $this->httpClient->request('POST', $url, [
                'json' => [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = $response->toArray();
                $content = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
                $content = preg_replace('/```json\n?|\n?```/', '', $content);
                $analysis = json_decode(trim($content), true);
                
                if (isset($analysis['scores'], $analysis['advice'])) {
                    return $analysis;
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('Gemini SMART Analysis failed: ' . $e->getMessage());
        }

        return [
            'scores' => ['S' => 0, 'M' => 0, 'A' => 0, 'R' => 0, 'T' => 0],
            'advice' => "L'analyse a échoué. Veuillez réessayer plus tard."
        ];
    }
}
