<?php

namespace App\Controller\Other;

use App\Entity\SuiviSante;
use App\Form\SuiviSanteType;
use App\Repository\BilanSanteRepository;
use App\Repository\SuiviSanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/suivi-sante')]
class SuiviSanteController extends AbstractController
{
    #[Route('/', name: 'app_suivi_sante_index', methods: ['GET'])]
    public function index(Request $request, BilanSanteRepository $bilanSanteRepository, SuiviSanteRepository $suiviSanteRepository): Response
    {
        $user = $this->getUser();
        
        // Sorting and Filtering
        $sort = $request->query->get('sort', 'date');
        $direction = $request->query->get('direction', 'DESC');
        $period = $request->query->get('period');

        $criteria = ['utilisateur' => $user];
        $orderBy = [$sort => $direction];

        // Basic period filtering (simple implementation)
        if ($period === 'week') {
            // This is a bit complex with simple findBy, would typically use QueryBuilder
            // For now, let's just fetch recent and filter in memory or ignore if too complex for findBy
            // Ideally: separate repository method. 
        }

        // Use custom repository method for more advanced filtering if needed
        // For now, stick to findBy for simplicity unless requested
        // Let's rely on standard findBy but maybe implement a QueryBuilder if needed.
        
        // Actually, let's implement a cleaner QueryBuilder approach in Repository?
        // Accessing repository directly here.
        
        $qb = $suiviSanteRepository->createQueryBuilder('s')
            ->where('s.utilisateur = :user')
            ->setParameter('user', $user);

        if ($period === 'week') {
             $qb->andWhere('s.date >= :date')
                ->setParameter('date', new \DateTime('-7 days'));
        } elseif ($period === 'month') {
             $qb->andWhere('s.date >= :date')
                ->setParameter('date', new \DateTime('-30 days'));
        }

        
        $allowedSorts = ['date', 'heuresSommeil', 'humeur', 'minutesActivite'];
        if (in_array($sort, $allowedSorts)) {
            $qb->orderBy('s.' . $sort, $direction);
        } else {
             $qb->orderBy('s.date', 'DESC');
        }

        $suivis = $qb->getQuery()->getResult();
        $bilans = $bilanSanteRepository->findBy(['utilisateur' => $user], ['date_fin' => 'DESC']);

        $latestBilan = $bilans[0] ?? null;

       
        
        $statsSuivis = $suiviSanteRepository->findBy(['utilisateur' => $user], ['date' => 'DESC'], 7);
        $avgSleep = 0;
        $avgWater = 0;
        if (count($statsSuivis) > 0) {
            $totalSleep = array_reduce($statsSuivis, fn($sum, $s) => $sum + $s->getHeuresSommeil(), 0);
            $totalWater = array_reduce($statsSuivis, fn($sum, $s) => $sum + $s->getVerresEau(), 0);
            $avgSleep = $totalSleep / count($statsSuivis);
            $avgWater = $totalWater / count($statsSuivis);
        }

        return $this->render('other/health/suivi_sante/index.html.twig', [
            'bilans' => $bilans,
            'suivis' => $suivis,
            'latestBilan' => $latestBilan,
            'avgSleep' => $avgSleep,
            'avgWater' => $avgWater,
            'currentSort' => $sort,
            'currentDirection' => $direction,
            'currentPeriod' => $period
        ]);
    }

    #[Route('/new', name: 'app_suivi_sante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $suivi = new SuiviSante();
        $suivi->setUtilisateur($this->getUser());
        $suivi->setDate(new \DateTime('today'));

        $form = $this->createForm(SuiviSanteType::class, $suivi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suivi);
            $entityManager->flush();

            return $this->redirectToRoute('app_suivi_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/suivi_sante/new.html.twig', [
            'suivi' => $suivi,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_suivi_sante_show', methods: ['GET'])]
    public function show(SuiviSante $suiviSante): Response
    {
        // Security check
        if ($suiviSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('other/health/suivi_sante/show.html.twig', [
            'suivi' => $suiviSante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_suivi_sante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuiviSante $suiviSante, EntityManagerInterface $entityManager): Response
    {
         if ($suiviSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(SuiviSanteType::class, $suiviSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_suivi_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/health/suivi_sante/edit.html.twig', [
            'suivi' => $suiviSante,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_suivi_sante_delete', methods: ['POST'])]
    public function delete(Request $request, SuiviSante $suiviSante, EntityManagerInterface $entityManager): Response
    {
         if ($suiviSante->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$suiviSante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($suiviSante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_suivi_sante_index', [], Response::HTTP_SEE_OTHER);
    }
}
