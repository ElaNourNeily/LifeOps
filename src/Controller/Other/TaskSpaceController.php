<?php

namespace App\Controller\Other;

use App\Entity\Tache;
use App\Entity\TaskSpace;
use App\Form\TaskSpaceType;
use App\Form\TacheAssignType;
use App\Repository\TacheRepository;
use App\Repository\TaskSpaceRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Security\TaskPermission; // <--- LA LIGNE À AJOUTER EST ICI
#[Route('/taskspace')]
#[IsGranted('ROLE_USER')]
class TaskSpaceController extends AbstractController
{
    // ══════════════════════════════════════════════════════════
    //  INDEX — All projects I lead OR am a member of
    // ══════════════════════════════════════════════════════════

    #[Route('/', name: 'app_taskspace_index', methods: ['GET'])]
    public function index(TaskSpaceRepository $tsRepo, TacheRepository $tacheRepo): Response
    {
        $user = $this->getUser();

        // Projects I created (I am the Leader)
        $myProjects = $tsRepo->findBy(
            ['utilisateur' => $user],
            ['date_creation' => 'DESC']
        );

        // Projects where I am a member
        $memberProjects = $this->getMemberProjects($user, $myProjects, $tacheRepo);

        return $this->render('other/task_space/index.html.twig', [
            'myProjects'     => $myProjects,
            'memberProjects' => $memberProjects,
        ]);
    }

    // ══════════════════════════════════════════════════════════
    //  BOARD — Kanban view of tasks inside a TaskSpace
    // ══════════════════════════════════════════════════════════

    #[Route('/{id}/board', name: 'app_taskspace_board', methods: ['GET'])]
    public function board(TaskSpace $taskSpace, TacheRepository $tacheRepo, UtilisateurRepository $userRepo): Response
    {
        $user = $this->getUser();
        $isLeader = $taskSpace->getUtilisateur() === $user;

        // 1. Récupération des tâches
        if ($isLeader) {
            $taches = $tacheRepo->findAllInTaskSpace($taskSpace);
        } else {
            $taches = $tacheRepo->findAssignedToMember($user, $taskSpace);
            
            if (empty($taches)) {
                throw $this->createAccessDeniedException("Vous n'avez pas accès à ce projet.");
            }
        }

        // 2. Tri dans les colonnes
        $columns = ['todo' => [], 'in-progress' => [], 'review' => [], 'done' => []];
        foreach ($taches as $t) {
            $s = $t->getStatut();
            $columns[array_key_exists($s, $columns) ? $s : 'todo'][] = $t;
        }

        // 3. Récupération des membres
        $members = $userRepo->findMembersOfTaskSpace($taskSpace);

        // 4. CALCUL DE LA PROGRESSION (NOUVEAU)
        $totalTasks = count($taches);
        $doneTasks = count($columns['done']);
        $progress = $totalTasks > 0 ? round(($doneTasks / $totalTasks) * 100) : 0;

        // 5. Envoi de toutes les données au template Twig
        return $this->render('other/task_space/board.html.twig', [
            'taskSpace' => $taskSpace,
            'columns'   => $columns,
            'isLeader'  => $isLeader,
            'members'   => $members,
            'progress'  => $progress,
            'total'     => $totalTasks, // <--- ON AJOUTE LE TOTAL ICI
            'done'      => $doneTasks, // <--- ON ENVOIE LA VARIABLE ICI
        ]);
    }

#[Route('/{id}/validate/{taskId}', name: 'app_taskspace_validate', methods: ['POST'])]
    public function validateTask(
        TaskSpace $taskSpace, 
        int $taskId, 
        Request $request, 
        TacheRepository $tacheRepo, 
        EntityManagerInterface $em
    ): Response {
        // Seul le leader du projet peut valider formellement une tâche
        $this->requireLeader($taskSpace);

        // On cherche la tâche spécifique
        $tache = $tacheRepo->find($taskId);
        
        // On vérifie qu'elle existe et qu'elle appartient bien à ce projet
        if ($tache && $tache->getTaskSpace() === $taskSpace) {
            
            // On la passe au statut "Terminé" (done)
            $tache->setStatut('done');
            $tache->setUpdatedAt(new \DateTimeImmutable());
            
            $em->flush();
            $this->addFlash('success', 'Tâche validée et terminée avec succès.');
        } else {
            $this->addFlash('error', 'Tâche introuvable.');
        }

        // On redirige vers la page précédente (le board ou la page des membres)
        $referer = $request->headers->get('referer');
        if ($referer) {
            return $this->redirect($referer);
        }

        return $this->redirectToRoute('app_taskspace_board', ['id' => $taskSpace->getId()]);
    }
    // ══════════════════════════════════════════════════════════
    //  LEADER ACTIONS — New, Edit, Delete, Assign, Invite, Members
    // ══════════════════════════════════════════════════════════

    #[Route('/new', name: 'app_taskspace_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $taskSpace = new TaskSpace();
        $taskSpace->setUtilisateur($this->getUser());

        $taskSpace->setDateCreation(new \DateTime());
        $form = $this->createForm(TaskSpaceType::class, $taskSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($taskSpace);
            $em->flush();
            $this->addFlash('success', 'Projet créé avec succès.');
            return $this->redirectToRoute('app_taskspace_index');
        }

        return $this->render('other/task_space/new.html.twig', [
            'taskSpace' => $taskSpace,
            'form'      => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_taskspace_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TaskSpace $taskSpace, EntityManagerInterface $em): Response
    {
        $this->requireLeader($taskSpace);

        $form = $this->createForm(TaskSpaceType::class, $taskSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Projet mis à jour.');
            return $this->redirectToRoute('app_taskspace_board', ['id' => $taskSpace->getId()]);
        }

        return $this->render('other/task_space/edit.html.twig', [
            'taskSpace' => $taskSpace,
            'form'      => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_taskspace_delete', methods: ['POST'])]
    public function delete(TaskSpace $taskSpace, Request $request, EntityManagerInterface $em): Response
    {
        $this->requireLeader($taskSpace);

        if ($this->isCsrfTokenValid('delete' . $taskSpace->getId(), $request->request->get('_token'))) {
            $em->remove($taskSpace);
            $em->flush();
            $this->addFlash('success', 'Projet supprimé avec toutes ses tâches.');
        }

        return $this->redirectToRoute('app_taskspace_index');
    }

    // ══════════════════════════════════════════════════════════
    //  ADD MEMBER (INVITE ACTION)
    // ══════════════════════════════════════════════════════════

    #[Route('/{id}/invite/{userId}/add', name: 'app_taskspace_add_member', methods: ['POST'])]
    public function addMember(
        TaskSpace $taskSpace, 
        int $userId, 
        UtilisateurRepository $userRepo, 
        EntityManagerInterface $em
    ): Response {
        // 🔐 TaskSpaceVoter: Seul le leader peut gérer les membres
        $this->denyAccessUnlessGranted(TaskPermission::SPACE_MANAGE->value, $taskSpace);

        $userToAdd = $userRepo->find($userId);

        if ($userToAdd) {
            // Création d'une "Tâche de bienvenue" pour l'intégrer au projet
            $tache = new Tache();
            $tache->setTitre('👋 Bienvenue dans le projet !');
$currentUser = $this->getUser();
$tache->setDescription('Vous avez été ajouté à ce projet collaboratif par ' . $currentUser->getPrenom() . '. Vous pouvez maintenant voir le tableau !');      
      $tache->setPriorite('low');
            $tache->setDifficulte(1);
            $tache->setStatut('todo');
            $tache->setCreatedAt(new \DateTimeImmutable());
            
            // Assignation
            $tache->setUtilisateur($userToAdd);
            $tache->setTaskSpace($taskSpace);

            $em->persist($tache);
            $em->flush();

            $this->addFlash('success', $userToAdd->getPrenom() . ' a été ajouté(e) au projet avec succès !');
        } else {
            $this->addFlash('error', 'Utilisateur introuvable.');
        }

        return $this->redirectToRoute('app_taskspace_invite', ['id' => $taskSpace->getId()]);
    }
    #[Route('/{id}/assign', name: 'app_taskspace_assign', methods: ['GET', 'POST'])]
    public function assignTask(TaskSpace $taskSpace, Request $request, UtilisateurRepository $userRepo, EntityManagerInterface $em): Response
    {
        $this->requireLeader($taskSpace);

        $members = $userRepo->findMembersOfTaskSpace($taskSpace);
        $members[] = $this->getUser(); 
        $members = array_unique($members, SORT_REGULAR);

        $tache = new Tache();
        $tache->setTaskSpace($taskSpace);

        $form = $this->createForm(TacheAssignType::class, $tache, [
            'members' => $members,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tache);
            $em->flush();
            $this->addFlash('success', 'Tâche assignée avec succès !');
            return $this->redirectToRoute('app_taskspace_board', ['id' => $taskSpace->getId()]);
        }

        return $this->render('other/task_space/assign.html.twig', [
            'taskSpace' => $taskSpace,
            'form'      => $form,
            'members'   => $members,
        ]);
    }

   #[Route('/{id}/invite', name: 'app_taskspace_invite', methods: ['GET'])]
    public function invite(TaskSpace $taskSpace, UtilisateurRepository $userRepo, Request $request): Response
    {
        $this->requireLeader($taskSpace);
        
        // Les membres actuels du projet
        $members = $userRepo->findMembersOfTaskSpace($taskSpace);
        
        // Ce qui a été tapé dans la barre de recherche
        $searchQuery = $request->query->get('q', '');
        
        // On prépare un tableau vide pour les résultats
        $searchResults = [];
        
        // S'il y a une recherche, on utilise le repository pour trouver les utilisateurs
        if ($searchQuery !== '') {
            $searchResults = $userRepo->searchForInvite($searchQuery, $this->getUser(), $taskSpace);
        }

        return $this->render('other/task_space/invite.html.twig', [
            'taskSpace'     => $taskSpace,
            'members'       => $members,
            'searchQuery'   => $searchQuery,
            'searchResults' => $searchResults, // On envoie les résultats à Twig !
        ]);
    }
   #[Route('/{id}/members', name: 'app_taskspace_members', methods: ['GET'])]
    public function members(TaskSpace $taskSpace, UtilisateurRepository $userRepo, TacheRepository $tacheRepo): Response
    {
        $this->requireLeader($taskSpace);

        $members = $userRepo->findMembersOfTaskSpace($taskSpace);
        $memberDetails = []; 
        $taskCounts = $tacheRepo->countPerMemberInTaskSpace($taskSpace);

        foreach ($members as $m) {
            // Toutes les tâches de ce membre
            $userTasks = $tacheRepo->findBy(['taskSpace' => $taskSpace, 'utilisateur' => $m], ['priorite' => 'DESC']);
            
            // On compte les tâches par statut pour ce membre
            $cols = ['todo' => 0, 'in-progress' => 0, 'review' => 0, 'done' => 0];
            foreach ($userTasks as $t) {
                $s = $t->getStatut();
                if (array_key_exists($s, $cols)) {
                    $cols[$s]++;
                } else {
                    $cols['todo']++;
                }
            }

            $memberDetails[] = [
                'user'  => $m,
                'count' => $taskCounts[$m->getId()] ?? 0,
                'total' => $taskCounts[$m->getId()] ?? 0,
                'tasks' => $userTasks,
                'cols'  => $cols // <--- ON AJOUTE LES STATS DÉTAILLÉES ICI
            ];
        }

        // On fait la même chose pour l'utilisateur actuel (myTasks, myCols)
        $myCount = $taskCounts[$this->getUser()->getId()] ?? 0;
        $myTasks = $tacheRepo->findBy(['taskSpace' => $taskSpace, 'utilisateur' => $this->getUser()], ['priorite' => 'DESC']);
        
        $myCols = ['todo' => 0, 'in-progress' => 0, 'review' => 0, 'done' => 0];
        foreach ($myTasks as $t) {
            $s = $t->getStatut();
            if (array_key_exists($s, $myCols)) {
                $myCols[$s]++;
            } else {
                $myCols['todo']++;
            }
        }

        return $this->render('other/task_space/members.html.twig', [
            'taskSpace'     => $taskSpace,
            'memberDetails' => $memberDetails,
            'myCount'       => $myCount,
            'myTotal'       => $myCount,
            'myTasks'       => $myTasks,
            'myCols'        => $myCols, // <--- On l'envoie aussi pour "mes tâches"
        ]);
    }



    #[Route('/{id}/remove-member/{memberId}', name: 'app_taskspace_remove_member', methods: ['POST'])]
    public function removeMember(
        TaskSpace $taskSpace, 
        int $memberId, 
        Request $request, 
        UtilisateurRepository $userRepo, 
        TacheRepository $tacheRepo, 
        EntityManagerInterface $em
    ): Response {
        // Seul le leader du projet peut retirer un membre
        $this->requireLeader($taskSpace);

        // Vérification de sécurité avec le token CSRF (correspond à 'remove-member-' ~ member.id dans Twig)
        if ($this->isCsrfTokenValid('remove-member-' . $memberId, $request->request->get('_token'))) {
            $member = $userRepo->find($memberId);
            
            if ($member) {
                // Trouver toutes les tâches de cet utilisateur dans ce projet
                $taches = $tacheRepo->findBy([
                    'taskSpace' => $taskSpace,
                    'utilisateur' => $member
                ]);
                
                // Supprimer toutes ces tâches
                foreach ($taches as $tache) {
                    $em->remove($tache);
                }
                
                $em->flush();
                $this->addFlash('success', 'Membre retiré et ses tâches supprimées avec succès.');
            }
        } else {
            $this->addFlash('error', 'Action non autorisée (Token invalide).');
        }

        // Rediriger vers la page d'invitation (ou de gestion des membres)
        return $this->redirectToRoute('app_taskspace_invite', ['id' => $taskSpace->getId()]);
    }
    // ── JSON ENDPOINTS ──────────────────────────────────────

    #[Route('/{id}/search-users', name: 'app_taskspace_search_users', methods: ['GET'])]
    public function searchUsers(TaskSpace $taskSpace, Request $request, UtilisateurRepository $userRepo): JsonResponse
    {
        $this->requireLeader($taskSpace);

        $query = $request->query->get('q', '');
        if (strlen($query) < 2) {
            return $this->json([]);
        }

        $results = $userRepo->searchForInvite($query, $this->getUser(), $taskSpace);

        $data = array_map(fn($u) => [
            'id'     => $u->getId(),
            'name'   => $u->getPrenom() . ' ' . $u->getNom(),
            'email'  => $u->getEmail(),
            'avatar' => strtoupper(substr($u->getPrenom(), 0, 1)),
        ], $results);

        return $this->json($data);
    }

    // ── Private helpers ──────────────────────────────────────

    private function requireLeader(TaskSpace $taskSpace): void
    {
        if ($taskSpace->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Seul le Leader peut effectuer cette action.');
        }
    }

    private function getMemberProjects($user, array $myProjects, TacheRepository $tacheRepo): array
    {
        $myIds = array_map(fn($p) => $p->getId(), $myProjects);

        $tasks = $tacheRepo->createQueryBuilder('t')
            ->select('t', 'ts')
            ->join('t.taskSpace', 'ts')
            ->where('t.utilisateur = :user')
            ->andWhere('ts.utilisateur != :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();

        $seen = [];
        $result = [];
        foreach ($tasks as $task) {
            $ts = $task->getTaskSpace();
            if ($ts && !isset($seen[$ts->getId()])) {
                $seen[$ts->getId()] = true;
                $result[] = $ts;
            }
        }

        return $result;
    }
}