<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load('.env');
$client = Symfony\Component\HttpClient\HttpClient::create();
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $_ENV['GEMINI_API_KEY'];
$data = $client->request('GET', $url)->toArray();
foreach ($data['models'] as $m) {
    echo "MODEL: " . $m['name'] . "\n";
}
