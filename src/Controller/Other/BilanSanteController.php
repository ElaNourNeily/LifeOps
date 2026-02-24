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
            $bilan->setRecommandations("Aucune donnée de suivi n'a été trouvée pour cette période. Commencez par enregistrer vos suivis quotidiens.");
            return;
        }

        foreach ($suivis as $s) {
            $bilan->addSuiviSante($s);
        }

        // ===== ANALYSE 100% IA (GEMINI) =====
        $aiResult = $aiService->analyseBurnout(array_map(fn($s) => [
            'date' => $s->getDate()->format('Y-m-d'),
            'heuresSommeil' => $s->getHeuresSommeil(),
            'qualiteSommeil' => $s->getQualiteSommeil(),
            'humeur' => $s->getHumeur(),
            'minutesActivite' => $s->getMinutesActivite(),
            'verresEau' => $s->getVerresEau(),
        ], $suivis));

        if ($aiResult) {
            // Application des résultats fournis par l'IA
            $bilan->setNiveauFatigue($aiResult['score_fatigue'] ?? 5);
            $bilan->setNiveauStress($aiResult['score_stress'] ?? 5);
            $bilan->setScoreForme($aiResult['score_forme'] ?? 5.0);
            
            $recomm = [
                "🤖 ANALYSE IA GÉNÉRÉE :",
                $aiResult['explication'] ?? "Analyse indisponible.",
                "\n💡 CONSEILS PERSONNALISÉS :",
                implode("\n", array_map(fn($c) => "- " . $c, $aiResult['conseils'] ?? []))
            ];
            
            $bilan->setRecommandations(implode("\n", $recomm));
            $bilan->setAnalyseIa($aiResult);
            $bilan->setRisqueBurnout(($aiResult['risque_burnout'] ?? 'Faible') !== 'Faible');
        } else {
            // Fallback minimal en cas d'erreur de l'API AI uniquement
            $bilan->setNiveauFatigue(5);
            $bilan->setNiveauStress(5);
            $bilan->setScoreForme(5);
            $bilan->setRisqueBurnout(false);
            $bilan->setRecommandations("🤖 Désolé, l'IA est temporairement indisponible pour analyser vos données. Cependant, vos données ont bien été enregistrées.");
        }
    }
}
