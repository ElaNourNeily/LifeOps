<?php

namespace App\Controller\User;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ModerationService;

#[Route('/feedback')]
class FeedbackController extends AbstractController
{
    #[Route('/', name: 'app_feedback_index', methods: ['GET'])]
    public function index(FeedbackRepository $feedbackRepository): Response
    {
        // Fetch all feedbacks that are either explicitly visible or not explicitly flagged
        $feedbacks = $feedbackRepository->createQueryBuilder('f')
            ->where('f.isVisible = :visible')
            ->orWhere('f.isVisible IS NULL')
            ->setParameter('visible', true)
            ->orderBy('f.date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('user/feedback/index.html.twig', [
            'feedbacks' => $feedbacks,
        ]);
    }

    #[Route('/new', name: 'app_feedback_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ModerationService $moderator): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feedback->setUtilisateur($this->getUser());
            $feedback->setDate(new \DateTime());
            $feedback->setStatut('nouveau');

            // AI Moderation check
            if ($moderator->isInappropriate($feedback->getMessage())) {
                $feedback->setIsVisible(false);
                $feedback->setStatut('flagged');
                $this->addFlash('danger', 'Votre message contient du contenu inapproprié et ne respecte pas nos règles de la communauté. Il a été masqué et envoyé pour examen.');
            } else {
                $this->addFlash('success', 'Merci pour votre retour ! Votre message a bien été envoyé.');
            }

            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_feedback_index');
        }

        return $this->render('user/feedback/new.html.twig', [
            'feedback' => $feedback,
            'form' => $form->createView(),
        ]);
    }
}
