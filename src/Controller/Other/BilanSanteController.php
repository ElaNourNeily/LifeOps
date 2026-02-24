<?php

namespace App\Controller\Other;

use App\Entity\BilanSante;
use App\Form\BilanSanteType;
use App\Repository\BilanSanteRepository;
use App\Repository\SuiviSanteRepository;
use App\Service\AiService;
use App\Service\HealthChatbotService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bilan-sante')]
class BilanSanteController extends AbstractController
{
    #[Route('/', name: 'app_bilan_sante_index', methods: ['GET'])]
    public function index(Request $request, BilanSanteRepository $bilanSanteRepository): Response
    {
        $user = $this->getUser();
        
        $sort = $request->query->get('sort', 'date_fin');
        $direction = $request->query->get('direction', 'DESC');

        $allowedSorts = ['date_fin', 'score_forme', 'niveau_stress', 'risque_burnout'];
        // Mapping simple names to doctrine fields if needed, but camelCase vs underscore...
        // Entity uses snake_case props? No, getter/setters are camelCase, but partial column mapping. 
        // Let's check Entity again. 
        // BilanSante fields: niveau_fatigue, niveau_stress, score_forme... but properties are camelCase in ORM? 
        // Wait, property names are private ?int $niveau_fatigue. So use 'niveau_fatigue'.

        $orderBy = $sort;
        if (!in_array($sort, ['niveau_fatigue', 'niveau_stress', 'score_forme', 'risque_burnout'])) {
            $orderBy = 'date_fin'; // Default
        }

        // Using QueryBuilder for safe sorting
        $qb = $bilanSanteRepository->createQueryBuilder('b')
            ->where('b.utilisateur = :user')
            ->setParameter('user', $user)
            ->orderBy('b.'.$orderBy, $direction);
        
        if ($request->query->get('filter') === 'risk') {
             $qb->andWhere('b.risque_burnout = true');
        }

        $bilans = $qb->getQuery()->getResult();

        return $this->render('other/health/bilan_sante/index.html.twig', [
            'bilans' => $bilans,
        ]);
    }

    #[Route('/new', name: 'app_bilan_sante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SuiviSanteRepository $suiviSanteRepository, AiService $aiService): Response
    {
        $bilan = new BilanSante();
        $bilan->setUtilisateur($this->getUser());
        
        // Default period: Last 7 days
        $today = new \DateTime('today');
        $lastWeek = new \DateTime('-7 days');
        
        $bilan->setDateDebut($lastWeek);
        $bilan->setDateFin($today);

        // Pre-calculate logic (now with AI)
        $this->calculateBilanData($bilan, $suiviSanteRepository, $aiService);

        $form = $this->createForm(BilanSanteType::class, $bilan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Optional: Recalculate if dates changed? 
            // The user might have manually edited the values, so we should trust the form data
            // UNLESS the user explicitly asks to recalculate. 
            // For now, assume form input is final.
            
            $entityManager->persist($bilan);
            $entityManager->flush();

            return $this->redirectToRoute('app_suivi_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/bilan_sante/new.html.twig', [
            'bilan' => $bilan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/chat', name: 'app_health_chat', methods: ['GET', 'POST'])]
    public function healthChat(Request $request, HealthChatbotService $chatbot, SuiviSanteRepository $suiviRepo, BilanSanteRepository $bilanRepo): Response
    {
        $responseMessage = null;
        $user = $this->getUser();

        if ($request->isMethod('POST')) {
            $question = $request->request->get('question');
            
            // Fetch real user data for context (average of last 7 days)
            $lastWeek = new \DateTime('-7 days');
            $suivis = $suiviRepo->createQueryBuilder('s')
                ->where('s.utilisateur = :user')
                ->andWhere('s.date >= :start')
                ->setParameter('user', $user)
                ->setParameter('start', $lastWeek)
                ->getQuery()
                ->getResult();

            $avgData = [
                'heuresSommeil' => 0,
                'humeur' => 0,
                'verresEau' => 0,
                'minutesActivite' => 0
            ];

            if (count($suivis) > 0) {
                foreach ($suivis as $s) {
                    $avgData['heuresSommeil'] += $s->getHeuresSommeil();
                    $avgData['humeur'] += $s->getHumeur();
                    $avgData['verresEau'] += $s->getVerresEau();
                    $avgData['minutesActivite'] += $s->getMinutesActivite();
                }
                $avgData['heuresSommeil'] = round($avgData['heuresSommeil'] / count($suivis), 1);
                $avgData['humeur'] = round($avgData['humeur'] / count($suivis), 1);
                $avgData['verresEau'] = round($avgData['verresEau'] / count($suivis), 0);
                $avgData['minutesActivite'] = round($avgData['minutesActivite'] / count($suivis), 0);
            }

            // Fetch latest Bilan info for more context
            $latestBilan = $bilanRepo->findOneBy(
                ['utilisateur' => $user],
                ['date_fin' => 'DESC']
            );

            $context = [
                'moyennes_hebdo' => $avgData,
                'dernier_bilan' => $latestBilan ? [
                    'score_forme' => $latestBilan->getScoreForme(),
                    'niveau_stress' => $latestBilan->getNiveauStress(),
                    'niveau_fatigue' => $latestBilan->getNiveauFatigue(),
                    'risque_burnout' => $latestBilan->isRisqueBurnout() ? 'Élevé' : 'Faible',
                    'recommandations_ia' => $latestBilan->getRecommandations()
                ] : 'Aucun bilan récent'
            ];

            $responseMessage = $chatbot->ask($context, $question);
        }

        return $this->render('other/health/chat/index.html.twig', [
            'response' => $responseMessage
        ]);
    }

    #[Route('/{id}', name: 'app_bilan_sante_show', methods: ['GET'])]
    public function show(BilanSante $bilanSante): Response
    {
         if ($bilanSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('other/health/bilan_sante/show.html.twig', [
            'bilan' => $bilanSante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bilan_sante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BilanSante $bilanSante, EntityManagerInterface $entityManager): Response
    {
        if ($bilanSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(BilanSanteType::class, $bilanSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bilan_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/bilan_sante/edit.html.twig', [
            'bilan' => $bilanSante,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_bilan_sante_delete', methods: ['POST'])]
    public function delete(Request $request, BilanSante $bilanSante, EntityManagerInterface $entityManager): Response
    {
        if ($bilanSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$bilanSante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bilanSante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bilan_sante_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/{id}/export', name: 'app_bilan_sante_export_pdf', methods: ['GET'])]
    public function exportPdf(BilanSante $bilan): Response
    {
        if ($bilan->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        // 1️⃣ Récupérer l'analyse IA
        $analyse = $bilan->getAnalyseIa();

        // 2️⃣ Récupérer les suivis liés au bilan
        $suivis = $bilan->getSuiviSantes();

        // 3️⃣ Générer le HTML
        $html = $this->renderView('other/health/pdf/bilan.html.twig', [
            'bilan' => $bilan,
            'analyse' => $analyse,
            'suivis' => $suivis
        ]);

        // 4️⃣ Configurer Dompdf
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="bilan_sante_'.$bilan->getId().'.pdf"'
            ]
        );
    }

    private function calculateBilanData(BilanSante $bilan, SuiviSanteRepository $repo, AiService $aiService): void
    {
        $suivis = $repo->createQueryBuilder('s')
            ->where('s.utilisateur = :user')
            ->andWhere('s.date >= :start')
            ->andWhere('s.date <= :end')
            ->setParameter('user', $bilan->getUtilisateur())
            ->setParameter('start', $bilan->getDateDebut())
            ->setParameter('end', $bilan->getDateFin())
            ->getQuery()
            ->getResult();

        if (count($suivis) === 0) {
            $bilan->setNiveauFatigue(5);
            $bilan->setNiveauStress(5);
            $bilan->setScoreForme(5);
            $bilan->setRisqueBurnout(false);
            $bilan->setRecommandations("Pas assez de données pour cette période.");
            return;
        }

        $totalSleep = 0;
        $totalQualite = 0;
        $totalHumeur = 0;
        $totalActivite = 0;
        $totalEau = 0;

        foreach ($suivis as $s) {
            $bilan->addSuiviSante($s);
            $totalSleep += $s->getHeuresSommeil();
            $totalQualite += $s->getQualiteSommeil();
            $totalHumeur += $s->getHumeur();
            $totalActivite += $s->getMinutesActivite();
            $totalEau += $s->getVerresEau();
        }

        $count = count($suivis);
        $avgSleep = $totalSleep / $count;
        $avgQualite = $totalQualite / $count;
        $avgHumeur = $totalHumeur / $count;
        $avgActivite = $totalActivite / $count;
        $avgEau = $totalEau / $count;

        // ===== CALCUL FATIGUE (1-10) =====
        // Basé sur: Sommeil (durée + qualité), Hydratation, Activité physique
        $fatigue = 5; // Base neutre
        
        // Impact du sommeil (durée)
        if ($avgSleep < 6) $fatigue += 2.5;
        elseif ($avgSleep < 7) $fatigue += 1;
        elseif ($avgSleep > 8.5) $fatigue -= 1.5;
        elseif ($avgSleep > 8) $fatigue -= 0.5;
        
        // Impact de la qualité du sommeil
        if ($avgQualite < 4) $fatigue += 3;
        elseif ($avgQualite < 6) $fatigue += 1.5;
        elseif ($avgQualite > 8) $fatigue -= 2;
        elseif ($avgQualite > 7) $fatigue -= 1;
        
        // Impact de l'hydratation (déshydratation = fatigue)
        if ($avgEau < 4) $fatigue += 1.5; // Très peu d'eau
        elseif ($avgEau < 6) $fatigue += 0.5; // Hydratation insuffisante
        elseif ($avgEau >= 8) $fatigue -= 0.5; // Bonne hydratation
        
        // Impact de l'activité physique
        if ($avgActivite < 15) $fatigue += 1; // Sédentarité = fatigue
        elseif ($avgActivite > 120) $fatigue += 1; // Suractivité = fatigue
        elseif ($avgActivite >= 30 && $avgActivite <= 60) $fatigue -= 1; // Activité optimale
        
        $fatigue = max(1, min(10, $fatigue));

        // ===== CALCUL STRESS (1-10) =====
        // Basé sur: Humeur, Qualité sommeil, Activité
        $stress = 5; // Base neutre
        
        // Impact de l'humeur (principal indicateur)
        if ($avgHumeur < 3) $stress += 4;
        elseif ($avgHumeur < 5) $stress += 2;
        elseif ($avgHumeur > 8) $stress -= 3;
        elseif ($avgHumeur > 7) $stress -= 1.5;
        
        // Impact de la qualité du sommeil (mauvais sommeil = stress)
        if ($avgQualite < 5) $stress += 1.5;
        elseif ($avgQualite > 7) $stress -= 1;
        
        // Impact de l'activité (trop peu ou trop = stress)
        if ($avgActivite < 10) $stress += 1; // Pas d'exutoire physique
        elseif ($avgActivite > 90) $stress += 0.5; // Surcharge d'activité
        elseif ($avgActivite >= 30 && $avgActivite <= 60) $stress -= 1; // Activité équilibrée
        
        $stress = max(1, min(10, $stress));

        // ===== CALCUL SCORE FORME (1-10) =====
        // Indicateur global de bien-être
        $score = 5; // Base neutre
        
        // Contribution de chaque facteur
        $score += ($avgQualite - 5) * 0.3; // Qualité sommeil (30%)
        $score += ($avgHumeur - 5) * 0.3; // Humeur (30%)
        $score += (($avgSleep - 7) / 2) * 0.2; // Durée sommeil optimale ~7h (20%)
        
        // Bonus activité physique
        if ($avgActivite >= 30 && $avgActivite <= 90) $score += 1;
        elseif ($avgActivite >= 15 && $avgActivite < 30) $score += 0.5;
        elseif ($avgActivite < 10) $score -= 0.5;
        
        // Bonus hydratation
        if ($avgEau >= 8) $score += 0.5;
        elseif ($avgEau < 4) $score -= 0.5;
        
        $score = max(1, min(10, $score));

        // ===== DÉTECTION RISQUE BURNOUT =====
        // Critères multiples pour une détection plus précise
        $burnoutScore = 0;
        
        // Critère 1: Fatigue élevée (poids: 3)
        if ($fatigue >= 8) $burnoutScore += 3;
        elseif ($fatigue >= 7) $burnoutScore += 1;
        
        // Critère 2: Stress élevé (poids: 3)
        if ($stress >= 8) $burnoutScore += 3;
        elseif ($stress >= 7) $burnoutScore += 1;
        
        // Critère 3: Humeur très basse (poids: 2)
        if ($avgHumeur < 4) $burnoutScore += 2;
        elseif ($avgHumeur < 5) $burnoutScore += 1;
        
        // Critère 4: Sommeil insuffisant (poids: 2)
        if ($avgSleep < 6 || $avgQualite < 5) $burnoutScore += 2;
        elseif ($avgSleep < 7 || $avgQualite < 6) $burnoutScore += 1;
        
        // Critère 5: Manque d'activité physique (poids: 1)
        if ($avgActivite < 15) $burnoutScore += 1;
        
        // Critère 6: Déshydratation chronique (poids: 1)
        if ($avgEau < 4) $burnoutScore += 1;
        
        // Seuil de risque: score >= 6/12 = risque élevé
        $burnout = ($burnoutScore >= 6);
 
        // ===== AI ANALYSIS =====
        $aiResult = $aiService->analyseBurnout(array_map(fn($s) => [
            'date' => $s->getDate()->format('Y-m-d'),
            'heuresSommeil' => $s->getHeuresSommeil(),
            'qualiteSommeil' => $s->getQualiteSommeil(),
            'humeur' => $s->getHumeur(),
            'minutesActivite' => $s->getMinutesActivite(),
            'verresEau' => $s->getVerresEau(),
            'poids' => $s->getPoids()
        ], $suivis));
 
        if ($aiResult) {
            // Override with AI findings
            $bilan->setRisqueBurnout(($aiResult['risque_burnout'] !== 'Faible'));
            $bilan->setNiveauFatigue($aiResult['score_fatigue'] ?? (int)round($fatigue));
            $bilan->setNiveauStress($aiResult['score_stress'] ?? (int)round($stress));
            $bilan->setScoreForme($aiResult['score_forme'] ?? (float)round($score, 1));
            
            $recomm = [
                "🤖 ANALYSE IA :",
                $aiResult['explication'],
                "\n💡 CONSEILS :",
                implode("\n", array_map(fn($c) => "- " . $c, $aiResult['conseils']))
            ];
            $bilan->setRecommandations(implode("\n", $recomm));
            $bilan->setAnalyseIa($aiResult);
            $bilan->setRisqueBurnout($aiResult['risque_burnout'] !== 'Faible');
            return;
        }

        // FALLBACK to manual calculation if AI fails or no API key
        $bilan->setNiveauFatigue((int)round($fatigue));
        $bilan->setNiveauStress((int)round($stress));
        $bilan->setScoreForme((float)round($score, 1));
        $bilan->setRisqueBurnout($burnout);

        // ===== RECOMMANDATIONS PERSONNALISÉES =====
        $recomm = [];
        
        // Recommandations sommeil
        if ($avgSleep < 6) {
            $recomm[] = "🛌 CRITIQUE: Vous dormez en moyenne {$avgSleep}h/nuit. Visez 7-8h minimum.";
        } elseif ($avgSleep < 7) {
            $recomm[] = "😴 Augmentez votre temps de sommeil (actuellement {$avgSleep}h, cible: 7-8h).";
        }
        
        if ($avgQualite < 5) {
            $recomm[] = "💤 Qualité de sommeil faible ({$avgQualite}/10). Évitez écrans et caféine le soir.";
        } elseif ($avgQualite < 6) {
            $recomm[] = "🌙 Améliorez votre qualité de sommeil: routine régulière, chambre fraîche et sombre.";
        }
        
        // Recommandations hydratation
        if ($avgEau < 4) {
            $recomm[] = "💧 ATTENTION: Hydratation insuffisante ({$avgEau} verres/jour). Buvez au moins 6-8 verres.";
        } elseif ($avgEau < 6) {
            $recomm[] = "💦 Pensez à boire plus d'eau (actuellement {$avgEau} verres/jour).";
        }
        
        // Recommandations activité
        if ($avgActivite < 15) {
            $recomm[] = "🏃 Trop sédentaire ({$avgActivite}min/jour). Visez 30min d'activité quotidienne.";
        } elseif ($avgActivite > 120) {
            $recomm[] = "⚡ Attention au surmenage physique ({$avgActivite}min/jour). Prévoyez des jours de repos.";
        } elseif ($avgActivite >= 30 && $avgActivite <= 60) {
            $recomm[] = "✅ Excellente régularité d'activité physique ! Continuez ainsi.";
        }
        
        // Recommandations humeur
        if ($avgHumeur < 4) {
            $recomm[] = "😔 Moral très bas ({$avgHumeur}/10). Envisagez d'en parler à un professionnel.";
        } elseif ($avgHumeur < 5) {
            $recomm[] = "🧘 Moral en baisse. Accordez-vous des moments de détente et de plaisir.";
        }
        
        // Alerte burnout
        if ($burnout) {
            $recomm[] = "⚠️ ALERTE BURNOUT (score: {$burnoutScore}/12): Risque élevé de surmenage détecté.";
            $recomm[] = "🚨 Actions urgentes: Repos immédiat, réduction des activités, consultation médicale recommandée.";
        } elseif ($burnoutScore >= 4) {
            $recomm[] = "⚡ Vigilance: Signes de fatigue accumulée. Prenez soin de vous avant que ça empire.";
        }
        
        // Message positif si tout va bien
        if (empty($recomm)) {
            $recomm[] = "🎉 Excellent équilibre de vie ! Tous vos indicateurs sont au vert.";
        }
        
        $bilan->setRecommandations(implode("\n", $recomm));
    }
}
