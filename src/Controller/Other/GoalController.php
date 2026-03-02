<?php

namespace App\Controller\Other;

use App\Entity\Objectif;
use App\Entity\PlanAction;
use App\Form\ObjectifType;
use App\Form\PlanActionType;
use App\Repository\ObjectifRepository;
use App\Service\QuoteService;
use App\Service\AIService;
use App\Service\RecommendationService;
use Nucleos\DompdfBundle\Wrapper\DompdfWrapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Knp\Component\Pager\PaginatorInterface;

#[Route('/goals')]
class GoalController extends AbstractController
{
    #[Route('/', name: 'app_goal_index', methods: ['GET'])]
    public function index(Request $request, ObjectifRepository $objectifRepository, QuoteService $quoteService, RecommendationService $recommendationService, PaginatorInterface $paginator): Response
    {
        $query = $request->query->get('q');
        $category = $request->query->get('categorie', 'all');
        $sort = $request->query->get('sort', 'date_fin_asc');

        $objectifsQuery = $objectifRepository->getSearchQuery($this->getUser(), $query, $category, $sort);
        
        $objectifs = $paginator->paginate(
            $objectifsQuery,
            $request->query->getInt('page', 1),
            6 // Nombre d'éléments par page
        );
        $quote = $quoteService->getRandomQuote();
        $recommendations = $recommendationService->getRecommendations($this->getUser());

        return $this->render('other/goal/index.html.twig', [
            'objectifs' => $objectifs,
            'current_query' => $query,
            'current_category' => $category,
            'current_sort' => $sort,
            'quote' => $quote,
            'recommendations' => $recommendations,
        ]);
    }

    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objectif = new Objectif();
        $objectif->setUtilisateur($this->getUser());
        $objectif->setStatut('in_progress');
        $objectif->setProgression(0);
        
        $form = $this->createForm(ObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($objectif);
            $entityManager->flush();

            $this->addFlash('success', 'Votre nouvel objectif "'. $objectif->getTitre() .'" a été créé avec succès !');

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/goal/new.html.twig', [
            'objectif' => $objectif,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goal_show', methods: ['GET'])]
    public function show(Objectif $objectif): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('other/goal/show.html.twig', [
            'objectif' => $objectif,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Objectif $objectif, EntityManagerInterface $entityManager): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(ObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'L\'objectif a été mis à jour.');

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/goal/edit.html.twig', [
            'objectif' => $objectif,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_goal_delete', methods: ['POST'])]
    public function delete(Request $request, Objectif $objectif, EntityManagerInterface $entityManager): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$objectif->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($objectif);
            $entityManager->flush();
            $this->addFlash('success', 'L\'objectif a été supprimé.');
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/toggle', name: 'app_goal_toggle', methods: ['POST'])]
    public function toggle(Request $request, Objectif $objectif, EntityManagerInterface $entityManager): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('toggle'.$objectif->getId(), $request->getPayload()->getString('_token'))) {
            $objectif->setStatut($objectif->getStatut() === 'achieved' ? 'in-progress' : 'achieved');
            $entityManager->flush();
            $this->addFlash('success', $objectif->getStatut() === 'achieved' ? 'Objectif marqué comme atteint !' : 'Objectif marqué comme en cours.');
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/action/new', name: 'app_goal_action_new', methods: ['GET', 'POST'])]
    public function newAction(Request $request, Objectif $objectif, EntityManagerInterface $entityManager): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        $planAction = new PlanAction();
        $planAction->setObjectif($objectif);
        $planAction->setStatut('todo');
        $planAction->setPriorite('medium');

        $form = $this->createForm(PlanActionType::class, $planAction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planAction);
            $entityManager->flush();
            $this->addFlash('success', 'L\'étape a été ajoutée au plan d\'action.');

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/goal/new_plan_action.html.twig', [
            'objectif' => $objectif,
            'plan_action' => $planAction,
            'form' => $form,
        ]);
    }
    #[Route('/{id}/ai-suggest', name: 'app_goal_ai_suggest', methods: ['POST'])]
    public function aiSuggest(Request $request, Objectif $objectif, AIService $aiService, EntityManagerInterface $entityManager, LoggerInterface $logger): Response
    {
        if ($objectif->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $logger->info('AI Suggest requested for Goal ID: ' . $objectif->getId());
        $logger->info('Request Method: ' . $request->getMethod());
        $logger->info('POST parameters: ' . json_encode($request->request->all()));

        $token = $request->request->get('_token');
        $tokenId = 'ai_suggest' . $objectif->getId();
        
        $logger->debug('Received token: ' . ($token ?? 'NULL'));
        $logger->debug('Expected Token ID: ' . $tokenId);

        if ($this->isCsrfTokenValid($tokenId, $token)) {
            // Optionnel : Nettoyer les étapes précédentes générées par l'IA
            foreach ($objectif->getPlanActions() as $existingAction) {
                if ($existingAction->getDescription() === 'Généré par IA') {
                    $entityManager->remove($existingAction);
                }
            }
            $entityManager->flush();

            $suggestedSteps = $aiService->suggestSteps($objectif->getTitre(), $objectif->getDescription());

            foreach ($suggestedSteps as $title) {
                $planAction = new PlanAction();
                $planAction->setTitre($title);
                $planAction->setStatut('todo');
                $planAction->setPriorite('moyenne');
                $planAction->setDescription('Généré par IA');
                $planAction->setObjectif($objectif);
                
                $entityManager->persist($planAction);
            }

            $entityManager->flush();
            $this->addFlash('success', 'Plan d\'action généré par l\'IA avec succès !');
        } else {
            $this->addFlash('error', 'Échec de la validation de sécurité (CSRF). Veuillez rafraîchir la page.');
            $logger->error('CSRF token invalid for ai_suggest. Goal ID: ' . $objectif->getId());
            $logger->debug('Received token: ' . ($token ?? 'NULL'));
            $logger->debug('Expected Token ID: ' . $tokenId);
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/action/{id}/edit', name: 'app_goal_action_edit', methods: ['GET', 'POST'])]
    public function editAction(Request $request, PlanAction $planAction, EntityManagerInterface $entityManager): Response
    {
        $objectif = $planAction->getObjectif();
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(PlanActionType::class, $planAction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'L\'étape a été mise à jour.');

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('other/goal/edit_plan_action.html.twig', [
            'plan_action' => $planAction,
            'form' => $form,
        ]);
    }

    #[Route('/action/{id}', name: 'app_goal_action_delete', methods: ['POST'])]
    public function deleteAction(Request $request, PlanAction $planAction, EntityManagerInterface $entityManager): Response
    {
        $objectif = $planAction->getObjectif();
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$planAction->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($planAction);
            $entityManager->flush();
            $this->addFlash('success', 'L\'étape a été supprimée.');
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/action/{id}/toggle', name: 'app_goal_action_toggle', methods: ['POST'])]
    public function toggleAction(Request $request, PlanAction $planAction, EntityManagerInterface $entityManager): Response
    {
        $objectif = $planAction->getObjectif();
        if ($objectif->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('toggle'.$planAction->getId(), $request->getPayload()->getString('_token'))) {
            $planAction->setStatut($planAction->getStatut() === 'done' ? 'todo' : 'done');
            $entityManager->flush();
            $this->addFlash('success', $planAction->getStatut() === 'done' ? 'Étape marquée comme terminée !' : 'Étape marquée comme à faire.');
        }

        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{id}/analyze-smart', name: 'app_goal_analyze_smart', methods: ['POST'])]
    public function analyzeSmart(Objectif $objectif, AIService $aiService): Response
    {
        $analysis = $aiService->analyzeGoalSMART($objectif->getTitre(), $objectif->getDescription() ?? '');
        
        return $this->json($analysis);
    }

    #[Route('/export/vision-board', name: 'app_goal_export_vision_board', methods: ['GET'])]
    public function exportVisionBoard(ObjectifRepository $objectifRepository, DompdfWrapperInterface $dompdfWrapper): Response
    {
        $objectifs = $objectifRepository->findBy(['utilisateur' => $this->getUser()], ['date_fin' => 'ASC']);
        
        $html = $this->renderView('other/goal/vision_board_pdf.html.twig', [
            'objectifs' => $objectifs,
        ]);
        
        return $dompdfWrapper->getStreamResponse($html, "vision-board-lifeops.pdf");
    }
}
