<?php

namespace App\Controller\User;

use App\Entity\Utilisateur;
use App\Form\ChangePasswordType;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/profile')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        /** @var Utilisateur $user */
        $user = $this->getUser();
        
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();

            if ($photoFile) {
                $newFilename = uniqid().'.'.$photoFile->guessExtension();

                try {
                    $photoFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/profile_pictures',
                        $newFilename
                    );
                    
                    // Delete old photo if it exists
                    if ($user->getPhoto()) {
                        $oldPhotoPath = $this->getParameter('kernel.project_dir').'/public/uploads/profile_pictures/'.$user->getPhoto();
                        if (file_exists($oldPhotoPath)) {
                            unlink($oldPhotoPath);
                        }
                    }

                    $user->setPhoto($newFilename);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès.');

            return $this->redirectToRoute('app_profile_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/change-password', name: 'app_profile_change_password', methods: ['GET', 'POST'])]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        /** @var Utilisateur $user */
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, null, [
            'require_current_password' => $user->hasSetPassword(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Utilisateur $user */
            $user = $this->getUser();
            
            $newPassword = $form->get('newPassword')->getData();
            
            // Encode the new password
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $newPassword
            );
            
            $user->setPassword($hashedPassword);
            $user->setHasSetPassword(true);
            $entityManager->flush();
            
            $this->addFlash('success', 'Mot de passe modifié avec succès.');

            return $this->redirectToRoute('app_profile_change_password', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/profile/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
