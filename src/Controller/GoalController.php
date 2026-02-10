<?php

namespace App\Controller;

use App\Entity\Objectif;
use App\Entity\PlanAction;
use App\Form\ObjectifType;
use App\Form\PlanActionType;
use App\Repository\ObjectifRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/goals')]
class GoalController extends AbstractController
{
    #[Route('/', name: 'app_goal_index', methods: ['GET'])]
    public function index(ObjectifRepository $objectifRepository): Response
    {
        return $this->render('goal/index.html.twig', [
            'objectifs' => $objectifRepository->findBy(['utilisateur' => $this->getUser()], ['date_fin' => 'ASC']),
        ]);
    }

    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $objectif = new Objectif();
        $objectif->setUtilisateur($this->getUser());
        $objectif->setStatut('in-progress');
        $objectif->setProgression(0);

        $form = $this->createForm(ObjectifType::class, $objectif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($objectif);
            $entityManager->flush();

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/new.html.twig', [
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

        return $this->render('goal/show.html.twig', [
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

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/edit.html.twig', [
            'objectif' => $objectif,
            'form' => $form,
        ]);
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

            return $this->redirectToRoute('app_goal_show', ['id' => $objectif->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/new_plan_action.html.twig', [
            'objectif' => $objectif,
            'plan_action' => $planAction,
            'form' => $form,
        ]);
    }
}
