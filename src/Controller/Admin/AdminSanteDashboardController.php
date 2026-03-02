<?php

namespace App\Controller\Admin;

use App\Entity\BilanSante;
use App\Entity\Utilisateur;
use App\Repository\BilanSanteRepository;
use App\Repository\UtilisateurRepository;
use App\Repository\SuiviSanteRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminSanteDashboardController extends AbstractDashboardController
{
    private UtilisateurRepository $userRepo;
    private BilanSanteRepository $bilanRepo;
    private SuiviSanteRepository $suiviRepo;

    public function __construct(
        UtilisateurRepository $userRepo, 
        BilanSanteRepository $bilanRepo,
        SuiviSanteRepository $suiviRepo
    ) {
        $this->userRepo = $userRepo;
        $this->bilanRepo = $bilanRepo;
        $this->suiviRepo = $suiviRepo;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // 1. Statistiques globales
        $totalUsers = $this->userRepo->count([]);
        
        // 2. Risque de burnout (Derniers bilans avec risque_burnout = true)
        $risqueEleve = $this->bilanRepo->count(['risque_burnout' => true]);
        
        // 3. Moyennes globales pour l'IA
        $totalBilans = $this->bilanRepo->count([]);
        
        // Calcul manuel simplifié des moyennes de stress/sommeil via QueryBuilder
        $avgStress = $this->bilanRepo->createQueryBuilder('b')
            ->select('AVG(b.niveau_stress)')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
            
        $avgSleep = $this->suiviRepo->createQueryBuilder('s')
            ->select('AVG(s.heuresSommeil)')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;

        return $this->render('admin/dashboard_sante.html.twig', [
            'totalUsers' => $totalUsers,
            'risqueEleve' => $risqueEleve,
            'totalBilans' => $totalBilans,
            'avgStress' => $avgStress,
            'avgSleep' => $avgSleep,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LifeOps - Monitoring Santé')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Tableau de Bord Santé', 'fa fa-chart-line', 'admin');
        yield MenuItem::linkToRoute('Retour au Site', 'fa fa-home', 'app_home');
    }
}
