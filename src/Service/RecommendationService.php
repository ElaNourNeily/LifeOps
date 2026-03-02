<?php

namespace App\Service;

use App\Repository\ObjectifRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class RecommendationService
{
    private $objectifRepository;

    public function __construct(ObjectifRepository $objectifRepository)
    {
        $this->objectifRepository = $objectifRepository;
    }

    /**
     * Analyzes the user's goals and returns recommended categories or templates.
     */
    public function getRecommendations(UserInterface $user): array
    {
        $objectifs = $this->objectifRepository->findBy(['utilisateur' => $user]);
        
        $stats = [
            'personal' => 0,
            'professional' => 0,
            'health' => 0,
            'finance' => 0
        ];

        foreach ($objectifs as $obj) {
            if (isset($stats[$obj->getCategorie()])) {
                $stats[$obj->getCategorie()]++;
            }
        }

        $recommendations = [];

        // Simple logic: if a category is empty, suggest it
        if ($stats['health'] === 0) {
            $recommendations[] = [
                'title' => 'Prenez soin de votre santé',
                'description' => 'Vous n\'avez pas d\'objectif santé actif. Pourquoi ne pas commencer par "Marcher 20 min par jour" ?',
                'category' => 'health'
            ];
        }

        if ($stats['finance'] === 0) {
            $recommendations[] = [
                'title' => 'Améliorez vos finances',
                'description' => 'Un objectif d\'épargne ou de budget pourrait vous aider à voir plus clair.',
                'category' => 'finance'
            ];
        }

        if (count($objectifs) > 0 && $stats['personal'] === 0) {
            $recommendations[] = [
                'title' => 'Épanouissement personnel',
                'description' => 'Pensez à ajouter un objectif de loisir ou d\'apprentissage pour votre équilibre.',
                'category' => 'personal'
            ];
        }

        return $recommendations;
    }
}
