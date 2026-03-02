<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load('.env');
$client = Symfony\Component\HttpClient\HttpClient::create();
$responses = [];
foreach(['v1', 'v1beta'] as $v) {
    $url = "https://generativelanguage.googleapis.com/$v/models?key=" . $_ENV['GEMINI_API_KEY'];
    $data = $client->request('GET', $url)->toArray();
    foreach($data['models'] as $m) {
        if (strpos($m['name'], 'pro') !== false) {
             echo $v . ": " . $m['name'] . "\n";
        }
    }
}
