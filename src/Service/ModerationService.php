<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class ModerationService
{
    private const API_URL = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey,
        private LoggerInterface $logger
    ) {}

    /**
     * Uses Gemini AI to review the feedback content.
     * Returns true if the content is inappropriate, false otherwise.
     */
    public function isInappropriate(string $content): bool
    {
        try {
            $response = $this->httpClient->request('POST', self::API_URL . '?key=' . $this->apiKey, [
                'json' => [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => "Analyze the following user feedback for a social application. 

                                CRITICAL INSTRUCTIONS:
                                - Respond ONLY with the word 'SAFE' if the content is appropriate.
                                - Respond ONLY with the word 'INAPPROPRIATE' if the content contains insults, slurs, vulgarity, or hate speech.
                                - Do NOT provide explanations. Do NOT use any other words.
                                
                                Feedback: \"" . $content . "\""]
                            ]
                        ]
                    ]
                ]
            ]);

            $result = $response->toArray();
            $aiResponse = trim($result['candidates'][0]['content']['parts'][0]['text'] ?? 'SAFE');
            
            $this->logger->info('AI raw response for moderation: "' . $aiResponse . '"');

            // Strict check to avoid failures if AI adds punctuation or case differences
            $cleanResponse = strtoupper(preg_replace('/[^a-zA-Z]/', '', $aiResponse));

            return $cleanResponse === 'INAPPROPRIATE';

        } catch (\Exception $e) {
            $this->logger->error('Gemini Moderation Error: ' . $e->getMessage());
            
            // Fallback to basic keyword check if AI fails
            return $this->fallbackCheck($content);
        }
    }

    private function fallbackCheck(string $content): bool
    {
        $inappropriateWords = [
            'insulte', 'merde', 'con', 'idiot', 'putain', 'salope', 'connard',
            'fuck', 'shit', 'bitch', 'asshole', 'bastard'
        ];
        $content = mb_strtolower($content);
        foreach ($inappropriateWords as $word) {
            if (str_contains($content, $word)) return true;
        }
        return false;
    }
}
