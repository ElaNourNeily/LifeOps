<?php

namespace App\Controller\Other;

use App\Entity\BilanSante;
use App\Entity\SuiviSante;
use App\Form\BilanSanteType;
use App\Form\SuiviSanteType;
use App\Repository\BilanSanteRepository;
use App\Repository\SuiviSanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/health')]
class HealthController extends AbstractController
{
    #[Route('/', name: 'app_health_index', methods: ['GET'])]
    public function index(BilanSanteRepository $bilanSanteRepository, SuiviSanteRepository $suiviSanteRepository): Response
    {
        $user = $this->getUser();
        
        $bilans = $bilanSanteRepository->findBy(['utilisateur' => $user], ['date_fin' => 'DESC']);
        $suivis = $suiviSanteRepository->findBy(['utilisateur' => $user], ['date' => 'DESC']);

        $latestBilan = $bilans[0] ?? null;

        // Calculate averages from last 7 suivis
        $recentSuivis = array_slice($suivis, 0, 7);
        $avgSleep = 0;
        $avgWater = 0;
        if (count($recentSuivis) > 0) {
            $totalSleep = array_reduce($recentSuivis, fn($sum, $s) => $sum + $s->getHeuresSommeil(), 0);
            $totalWater = array_reduce($recentSuivis, fn($sum, $s) => $sum + $s->getVerresEau(), 0);
            $avgSleep = $totalSleep / count($recentSuivis);
            $avgWater = $totalWater / count($recentSuivis);
        }

        return $this->render('other/health/index.html.twig', [
            'bilans' => $bilans,
            'suivis' => $suivis,
            'latestBilan' => $latestBilan,
            'avgSleep' => $avgSleep,
            'avgWater' => $avgWater,
        ]);
    }

    #[Route('/bilan/new', name: 'app_bilan_new', methods: ['GET', 'POST'])]
    public function newBilan(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bilan = new BilanSante();
        $bilan->setUtilisateur($this->getUser());
        $bilan->setDateDebut(new \DateTime('-7 days'));
        $bilan->setDateFin(new \DateTime('today'));
        $bilan->setRisqueBurnout(0); // Default

        $form = $this->createForm(BilanSanteType::class, $bilan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bilan);
            $entityManager->flush();

            return $this->redirectToRoute('app_health_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/new_bilan.html.twig', [
            'bilan' => $bilan,
            'form' => $form,
        ]);
    }

    #[Route('/suivi/new', name: 'app_suivi_new', methods: ['GET', 'POST'])]
    public function newSuivi(Request $request, EntityManagerInterface $entityManager): Response
    {
        $suivi = new SuiviSante();
        $suivi->setUtilisateur($this->getUser());
        $suivi->setDate(new \DateTime('today'));

        $form = $this->createForm(SuiviSanteType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suivi);
            $entityManager->flush();

            return $this->redirectToRoute('app_health_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/new_suivi.html.twig', [
            'suivi' => $suivi,
            'form' => $form,
        ]);
    }
}
