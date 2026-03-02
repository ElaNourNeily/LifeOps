<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class QuoteService
{
    private $httpClient;
    private $logger;
    private $cache;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger, CacheInterface $cache)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->cache = $cache;
    }

    /**
     * Fetches a motivational quote specifically about success/motivation from Quotable API.
     */
    public function getRandomQuote(): ?array
    {
        try {
            return $this->cache->get('daily_motivational_quote', function (ItemInterface $item) {
                $item->expiresAfter(86400); // 24 hours
                
                // Using Quotable API with tags for motivation and success
                // verify_peer => false is used because the API currently has SSL certificate issues
                $response = $this->httpClient->request('GET', 'https://api.quotable.io/random?tags=motivational|success', [
                    'verify_peer' => false,
                ]);

                if ($response->getStatusCode() === 200) {
                    $data = $response->toArray();
                    return [
                        'text' => $data['content'] ?? "L'action est la clé fondamentale de tout succès.",
                        'author' => $data['author'] ?? "Pablo Picasso"
                    ];
                }
                
                throw new \Exception('Failed to fetch from Quotable API');
            });
        } catch (\Exception $e) {
            $this->logger->error('Failed to get motivational quote: ' . $e->getMessage());
        }

        // Final fallback in case both API and cache fail
        return [
            'text' => "Le futur appartient à ceux qui croient à la beauté de leurs rêves.",
            'author' => "Eleanor Roosevelt"
        ];
    }
}
