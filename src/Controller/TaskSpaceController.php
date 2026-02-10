<?php

namespace App\Controller;

use App\Entity\TaskSpace;
use App\Entity\Tache;
use App\Form\TaskSpaceType;
use App\Repository\TaskSpaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projects')]
class TaskSpaceController extends AbstractController
{
    #[Route('/', name: 'app_projects_index', methods: ['GET'])]
    public function index(Request $request, TaskSpaceRepository $taskSpaceRepository): Response
    {
        $searchTerm = $request->query->get('search');
        $sortBy = $request->query->get('sort');
        $sortDirection = $request->query->get('direction', 'ASC');
        
        $projects = $taskSpaceRepository->search($this->getUser(), $searchTerm, $sortBy, $sortDirection);

        return $this->render('task_space/index.html.twig', [
            'projects' => $projects,
            'search' => $searchTerm,
            'currentSort' => $sortBy,
            'currentDirection' => $sortDirection,
        ]);
    }

    #[Route('/new', name: 'app_projects_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taskSpace = new TaskSpace();
        $taskSpace->setUtilisateur($this->getUser());
        $taskSpace->setDateCreation(new \DateTime());

        $form = $this->createForm(TaskSpaceType::class, $taskSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($taskSpace);
            $entityManager->flush();

            return $this->redirectToRoute('app_projects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task_space/new.html.twig', [
            'taskSpace' => $taskSpace,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_projects_show', methods: ['GET'])]
    public function show(TaskSpace $taskSpace): Response
    {
        if ($taskSpace->getUtilisateur() !== $this->getUser() && !$taskSpace->getMembers()->contains($this->getUser())) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('task_space/show.html.twig', [
            'taskSpace' => $taskSpace,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_projects_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TaskSpace $taskSpace, EntityManagerInterface $entityManager): Response
    {
        if ($taskSpace->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(TaskSpaceType::class, $taskSpace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_projects_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task_space/edit.html.twig', [
            'taskSpace' => $taskSpace,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_projects_delete', methods: ['POST'])]
    public function delete(Request $request, TaskSpace $taskSpace, EntityManagerInterface $entityManager): Response
    {
        if ($taskSpace->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$taskSpace->getId(), $request->request->get('_token'))) {
            $entityManager->remove($taskSpace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_projects_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/convert', name: 'app_tasks_convert_to_project', methods: ['POST'])]
    public function convertToProject(Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($tache->getUtilisateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($tache->getTaskSpace()) {
            $this->addFlash('warning', 'Cette tâche est déjà dans un projet.');
            return $this->redirectToRoute('app_tasks_index');
        }

        $taskSpace = new TaskSpace();
        $taskSpace->setNom($tache->getTitre());
        $taskSpace->setDescription($tache->getDescription());
        $taskSpace->setUtilisateur($this->getUser());
        $taskSpace->setDateCreation(new \DateTime());
        $taskSpace->setStatus('Active');
        $taskSpace->setSprintDuration(14);

        $entityManager->persist($taskSpace);
        
        $tache->setTaskSpace($taskSpace);
        
        $entityManager->flush();

        $this->addFlash('success', 'Tâche convertie en projet !');

        return $this->redirectToRoute('app_projects_edit', ['id' => $taskSpace->getId()]);
    }
}