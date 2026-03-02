<?php

namespace App\Controller\Other;

use App\Service\AIPlannerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AIController extends AbstractController
{
    #[Route('/ai/optimize', name: 'app_ai_optimize', methods: ['POST'])]
    public function optimize(Request $request, AIPlannerService $aiService): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Utilisateur non connecté'], 401);
        }

        $userRequest = $request->request->get('request', 'Optimise ma semaine en fonction de mes priorités');
        
        // Use a 3-day window instead of 7 to reduce token count and quota pressure
        $startDate = new \DateTime('today');
        $endDate = (clone $startDate)->modify('+3 days');

        $suggestions = $aiService->optimizePlanning($userRequest, $startDate, $endDate, $user->getId());

        return $this->json($suggestions);
    }

    #[Route('/ai/confirm', name: 'app_ai_confirm', methods: ['POST'])]
    public function confirm(Request $request, AIPlannerService $aiService): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Utilisateur non connecté'], 401);
        }

        $data = json_decode($request->getContent(), true);
        $suggestions = $data['suggestions'] ?? [];

        if (empty($suggestions)) {
            return $this->json(['error' => 'Aucune suggestion à confirmer'], 400);
        }

        try {
            $aiService->saveConfirmedSuggestions($suggestions, $user);
            return $this->json(['success' => true, 'message' => 'Les recommandations ont été enregistrées avec succès !']);
        } catch (\Exception $e) {
            return $this->json(['error' => 'Erreur lors de l\'enregistrement : ' . $e->getMessage()], 500);
        }
    }
}
