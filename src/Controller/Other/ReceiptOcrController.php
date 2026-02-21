<?php

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class ReceiptOcrController extends AbstractController
{
    private string $pythonServiceUrl;

    public function __construct()
    {
        $this->pythonServiceUrl = $_ENV['PYTHON_SERVICE_URL'] ?? 'http://localhost:5000';
    }

    #[Route('/depense/process-receipt', name: 'app_process_receipt', methods: ['POST'])]
    public function processReceipt(Request $request): JsonResponse
    {
        // Prevent PHP timeout during long OCR/AI processing (up to 5 minutes)
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        // Verify user is authenticated
        if (!$this->getUser()) {
            return $this->json(['error' => 'Not authenticated'], 401);
        }

        try {
            $uploadedFile = $request->files->get('receipt');

            if (!$uploadedFile) {
                return $this->json(['error' => '[SF-FILES-MISSING] No receipt image provided in Symfony request'], 400);
            }

            // Create multipart form data correctly for HttpClient
            $client = HttpClient::create();
            
            $formData = new FormDataPart([
                'receipt' => DataPart::fromPath($uploadedFile->getPathname(), $uploadedFile->getClientOriginalName(), $uploadedFile->getClientMimeType()),
            ]);

            $response = $client->request('POST', $this->pythonServiceUrl . '/api/process-receipt', [
                'headers' => array_merge(
                    ['Accept' => 'application/json'],
                    $formData->getPreparedHeaders()->toArray()
                ),
                'body' => $formData->bodyToIterable(),
                'timeout' => 180,
                'max_duration' => 180,
            ]);

            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                $errorData = $response->toArray(false);
                return $this->json(['error' => $errorData['error'] ?? 'Python service returned error ' . $statusCode], $statusCode);
            }

            $data = $response->toArray();

            if (!isset($data['success']) || !$data['success']) {
                return $this->json(['error' => $data['error'] ?? 'Failed to process receipt'], 400);
            }

            // Return processed data
            return $this->json([
                'success' => true,
                'montant' => $data['montant'] ?? null,
                'categorie' => $data['categorie'] ?? null,
                'date' => $data['date'] ?? null,
                'typePaiement' => $data['typePaiement'] ?? null,
                'titre' => $data['titre'] ?? null,
            ]);

        } catch (\Throwable $e) {
            return $this->json([
                'error' => 'Error processing receipt: ' . $e->getMessage()
            ], 500);
        }
    }
}