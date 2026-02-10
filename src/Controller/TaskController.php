<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/tasks')]
class TaskController extends AbstractController
{
    #[Route('/', name: 'app_tasks_index', methods: ['GET'])]
    public function index(Request $request, TacheRepository $tacheRepository): Response
    {
        $searchTerm = $request->query->get('search');
        $sortBy = $request->query->get('sort');
        $sortDirection = $request->query->get('direction', 'ASC');

        $taches = $tacheRepository->search($this->getUser(), $searchTerm, $sortBy, $sortDirection);

        return $this->render('task/index.html.twig', [
            'taches' => $taches,
            'search' => $searchTerm,
            'currentSort' => $sortBy,
            'currentDirection' => $sortDirection,
        ]);
    }

    #[Route('/new', name: 'app_tasks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tache = new Tache();
        $tache->setUtilisateur($this->getUser());

        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            return $this->redirectToRoute('app_tasks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/new.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tasks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($tache->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tache->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_tasks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/edit.html.twig', [
            'tache' => $tache,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tasks_delete', methods: ['POST'])]
    public function delete(Request $request, Tache $tache, EntityManagerInterface $entityManager): Response
    {
        if ($tache->getUtilisateur() !== $this->getUser()) {
             throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$tache->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tache);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tasks_index', [], Response::HTTP_SEE_OTHER);
    }
}