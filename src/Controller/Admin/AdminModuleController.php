<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\UtilisateurRepository;
use App\Repository\FeedbackRepository;
use App\Entity\Utilisateur;
use App\Entity\Feedback;

#[Route('/admin')]
class AdminModuleController extends AbstractController
{

    #[Route('/users/{id}/feedbacks', name: 'app_admin_user_feedbacks')]
    public function userFeedbacks(Utilisateur $user, Request $request, FeedbackRepository $feedbackRepo): Response
    {
        $sort = $request->query->get('sort', 'date');
        $direction = strtoupper($request->query->get('direction', 'DESC'));
        
        if (!in_array($sort, ['date', 'note'])) $sort = 'date';
        if (!in_array($direction, ['ASC', 'DESC'])) $direction = 'DESC';

        return $this->render('admin/module/user_feedbacks.html.twig', [
            'user' => $user,
            'feedbacks' => $feedbackRepo->findBy(['utilisateur' => $user], [$sort => $direction]),
            'currentSort' => $sort,
            'currentDirection' => $direction,
        ]);
    }

    #[Route('/feedback', name: 'app_admin_feedback')]
    public function feedback(Request $request, FeedbackRepository $feedbackRepo): Response
    {
        $filter = $request->query->get('filter');
        $type = $request->query->get('type');
        $sort = $request->query->get('sort', 'date');
        $direction = strtoupper($request->query->get('direction', 'DESC'));
        
        // Validate sort and direction to prevent injection
        if (!in_array($sort, ['date', 'note'])) $sort = 'date';
        if (!in_array($direction, ['ASC', 'DESC'])) $direction = 'DESC';

        $criteria = [];
        if ($filter === 'flagged') {
            $criteria['isVisible'] = false;
        }
        if ($type) {
            $criteria['type_feedback'] = $type;
        }
        
        $feedbacks = $feedbackRepo->findBy($criteria, [$sort => $direction]);
        
        // Calculate global statistics (always based on ALL feedbacks for consistency)
        $allFeedbacks = $feedbackRepo->findAll();
        $total = count($allFeedbacks);
        $flagged = 0;
        $sum = 0;
        $distribution = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($allFeedbacks as $f) {
            if (!$f->isVisible()) {
                $flagged++;
            }
            $note = $f->getNote();
            $sum += $note;
            if (isset($distribution[$note])) {
                $distribution[$note]++;
            }
        }

        $average = $total > 0 ? round($sum / $total, 1) : 0;

        return $this->render('admin/module/list_feedbacks.html.twig', [
            'feedbacks' => $feedbacks,
            'currentFilter' => $filter,
            'currentType' => $type,
            'currentSort' => $sort,
            'currentDirection' => $direction,
            'stats' => [
                'total' => $total,
                'flagged' => $flagged,
                'average' => $average,
                'distribution' => $distribution,
            ]
        ]);
    }

    #[Route('/feedback/{id}/delete', name: 'app_admin_feedback_delete', methods: ['POST'])]
    public function deleteFeedback(Feedback $feedback, EntityManagerInterface $em): Response
    {
        $em->remove($feedback);
        $em->flush();
        $this->addFlash('success', 'Feedback supprimé avec succès.');
        return $this->redirectToRoute('app_admin_feedback');
    }

    #[Route('/feedback/{id}/ban', name: 'app_admin_user_ban', methods: ['POST'])]
    public function banUser(Feedback $feedback, EntityManagerInterface $em): Response
    {
        $user = $feedback->getUtilisateur();
        if ($user) {
            $user->setBanUntil((new \DateTime())->add(new \DateInterval('P30D'))); // Ban for 30 days
            $em->remove($feedback); // Usually we also remove the offensive feedback
            $em->flush();
            $this->addFlash('danger', sprintf('Utilisateur %s banni pour 30 jours et feedback supprimé.', $user->getEmail()));
        }
        return $this->redirectToRoute('app_admin_feedback');
    }

    #[Route('/sante', name: 'app_admin_sante')]
    public function sante(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'sante',
        ]);
    }

    #[Route('/finances', name: 'app_admin_finances')]
    public function finances(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'finances',
        ]);
    }

    #[Route('/temps', name: 'app_admin_temps')]
    public function temps(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'temps',
        ]);
    }

    #[Route('/taches', name: 'app_admin_taches')]
    public function taches(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'taches',
        ]);
    }

    #[Route('/objectifs', name: 'app_admin_objectifs')]
    public function objectifs(): Response
    {
        return $this->render('admin/module/index.html.twig', [
            'module_name' => 'objectifs',
        ]);
    }
}
