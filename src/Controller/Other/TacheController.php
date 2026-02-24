<?php

namespace App\Controller\Other;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use App\Repository\TaskSpaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\AiClientService;

#[Route('/tasks')]
#[IsGranted('ROLE_USER')]
class TacheController extends AbstractController
{
    // ══════════════════════════════════════════════════════════
    //  INDEX — All personal tasks (Solo mode)
    // ══════════════════════════════════════════════════════════

    #[Route('/', name: 'app_tasks_index', methods: ['GET'])]
    public function index(TacheRepository $repo): Response
    {
        $taches = $repo->findAllForUser($this->getUser());

        return $this->render('other/task/index.html.twig', [
            'taches' => $taches,
        ]);
    }

    // ══════════════════════════════════════════════════════════
    //  BOARD — Personal solo Kanban
    // ══════════════════════════════════════════════════════════

   #[Route('/board', name: 'app_tasks_board', methods: ['GET'])]
public function board(TacheRepository $repo, AiClientService $aiService): Response
{
    $taches = $repo->findSoloTasks($this->getUser());

    // ✅ Build Kanban columns (your original logic)
    $columns = ['todo' => [], 'in-progress' => [], 'review' => [], 'done' => []];
    foreach ($taches as $t) {
        $s = $t->getStatut();
        $columns[array_key_exists($s, $columns) ? $s : 'todo'][] = $t;
    }

    // ✅ CALL AI ONLY FOR TODO TASKS (important design choice)
    $todoTasks = $columns['todo'];

    $aiSuggestions = [];
    if (!empty($todoTasks)) {
        $aiSuggestions = $aiService->prioritizeTasks($todoTasks);
    }

    return $this->render('other/task/board.html.twig', [
        'columns' => $columns,
        'aiSuggestions' => $aiSuggestions
    ]);
}
#[Route('/ai-suggestions', name: 'app_tasks_ai_suggestions', methods: ['GET'])]
public function aiSuggestions(TacheRepository $repo, AiClientService $aiService): Response{    $taches = $repo->findSoloTasks($this->getUser());

    // Only prioritize TODO tasks
    $todoTasks = array_filter($taches, fn($t) => $t->getStatut() === 'todo');

    if (empty($todoTasks)) {
        return $this->json([
            'suggested_order' => []
        ]);
    }

    $result = $aiService->prioritizeTasks($todoTasks);

    return $this->json($result);
}
// ══════════════════════════════════════════════════════════
    //  AI FEATURES
    // ══════════════════════════════════════════════════════════

    #[Route('/ai-overload', name: 'app_tasks_ai_overload', methods: ['GET'])]
    public function aiOverload(
        TacheRepository $repo,
        AiClientService $aiService
    ): Response {
        
        // Use findAllForUser to match your existing repository methods
        $taches = $repo->findAllForUser($this->getUser());

        // array_values is critical here to reset keys to 0, 1, 2... 
        // Otherwise PHP sends an object {} instead of a list [] to Python!
        $activeTasks = array_values(array_filter($taches, fn($t) =>
            in_array($t->getStatut(), ['todo', 'in-progress'])
        ));

        // Only ask AI if there are actually active tasks to check
        if (empty($activeTasks)) {
            return $this->json(['overloaded' => false]);
        }

        $result = $aiService->detectOverload($activeTasks);

        return $this->json($result);
    }
    // ══════════════════════════════════════════════════════════
    //  NEW — Create a Solo task
    // ══════════════════════════════════════════════════════════

    #[Route('/new', name: 'app_tasks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em,): Response
    {
        $tache = new Tache();
        $tache->setUtilisateur($this->getUser());
        
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche créée avec succès.');
            

            return $this->redirectToRoute('app_tasks_index');
        }

        return $this->render('other/task/new.html.twig', [
            'tache' => $tache,
            'form'  => $form,
        ]);
    }

    // ══════════════════════════════════════════════════════════
    //  SHOW, EDIT, STATUS, DELETE
    // ══════════════════════════════════════════════════════════

    #[Route('/{id}', name: 'app_tasks_show', methods: ['GET'])]
    public function show(Tache $tache): Response
    {
        $this->checkAccess($tache);
        return $this->render('other/task/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tasks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, EntityManagerInterface $em): Response
    {
        $this->checkAccess($tache);

        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setUpdatedAt(new \DateTimeImmutable());
            $em->flush();
            $this->addFlash('success', 'Tâche modifiée avec succès.');

            return $this->redirectBack($tache);
        }

        return $this->render('other/task/edit.html.twig', [
            'tache' => $tache,
            'form'  => $form,
        ]);
    }

    #[Route('/{id}/status', name: 'app_tasks_status', methods: ['POST'])]
    public function updateStatus(Tache $tache, Request $request, EntityManagerInterface $em): Response
    {
        $this->checkAccess($tache);

        $valid     = ['todo', 'in-progress', 'review', 'done'];
        $newStatut = $request->request->get('statut');

        if (!in_array($newStatut, $valid, true)) {
            return $this->json(['error' => 'Statut invalide'], 400);
        }

        // Si l'utilisateur n'est pas leader, il ne peut pas passer en "done"
        $ts = $tache->getTaskSpace();
        if ($newStatut === 'done' && $ts !== null && $ts->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Seul le Leader peut terminer la tâche.');
        }

        $tache->setStatut($newStatut);
        $tache->setUpdatedAt(new \DateTimeImmutable());
        $em->flush();

        if ($request->isXmlHttpRequest()) {
            return $this->json(['success' => true]);
        }

        return $this->redirectBack($tache);
    }

    #[Route('/{id}/delete', name: 'app_tasks_delete', methods: ['POST'])]
    public function delete(Tache $tache, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $taskSpace = $tache->getTaskSpace();

        if ($taskSpace === null && $tache->getUtilisateur() !== $user) {
            throw $this->createAccessDeniedException();
        }
        if ($taskSpace !== null && $taskSpace->getUtilisateur() !== $user) {
            throw $this->createAccessDeniedException('Seul le Leader peut supprimer des tâches du projet.');
        }

        if ($this->isCsrfTokenValid('delete' . $tache->getId(), $request->request->get('_token'))) {
            $redirectUrl = $taskSpace
                ? $this->generateUrl('app_taskspace_board', ['id' => $taskSpace->getId()])
                : $this->generateUrl('app_tasks_index');

            $em->remove($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche supprimée.');
            return $this->redirect($redirectUrl);
        }

        return $this->redirectBack($tache);
    }

    // ── Helpers ──────────────────────────────────────────────

    private function checkAccess(Tache $tache): void
    {
        $user      = $this->getUser();
        $taskSpace = $tache->getTaskSpace();
        $isLeader  = $taskSpace && $taskSpace->getUtilisateur() === $user;
        $isAssigned = $tache->getUtilisateur() === $user;

        if (!$isLeader && !$isAssigned) {
            throw $this->createAccessDeniedException();
        }
    }

    private function redirectBack(Tache $tache): Response
    {
        $ts = $tache->getTaskSpace();
        return $ts
            ? $this->redirectToRoute('app_taskspace_board', ['id' => $ts->getId()])
            : $this->redirectToRoute('app_tasks_board');
    }
}