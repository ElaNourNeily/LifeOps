<?php

namespace App\Controller\User;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use App\Repository\UtilisateurRepository;

class RegistrationController extends AbstractController
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager
    ): Response
    {
        if ($this->getUser()) {
             $roles = method_exists($this->getUser(), 'getRoles') ? $this->getUser()->getRoles() : [];
            if (in_array('ROLE_ADMIN', $roles, true)) {
                return $this->redirectToRoute('app_admin_dashboard');
            }
            return $this->redirectToRoute('app_dashboard');
        }
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            $user->setRole('ROLE_USER');

            // Generate 6-digit verification code
            $code = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $user->setVerificationCode($code);
            $user->setVerificationCodeExpiresAt(new \DateTimeImmutable('+15 minutes'));

            $entityManager->persist($user);
            $entityManager->flush();

            // Send email with the code
            $email = (new TemplatedEmail())
                ->from(new Address('life.ops.esprit@gmail.com', 'LifeOps Mail Bot'))
                ->to($user->getEmail())
                ->subject('Votre code de vérification LifeOps')
                ->htmlTemplate('user/registration/confirmation_email.html.twig')
                ->context([
                    'verificationCode' => $code,
                ]);

            $this->mailer->send($email);

            // Store email in session to know which user to verify
            $request->getSession()->set('pending_verification_email', $user->getEmail());

            return $this->redirectToRoute('app_verify_code');
        }

        return $this->render('user/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/code', name: 'app_verify_code')]
    public function verifyCode(Request $request, UtilisateurRepository $utilisateurRepository, EntityManagerInterface $entityManager): Response
    {
        $email = $request->getSession()->get('pending_verification_email');

        if (!$email) {
            return $this->redirectToRoute('app_register');
        }

        if ($request->isMethod('POST')) {
            $code = $request->request->get('code');
            $user = $utilisateurRepository->findOneBy(['email' => $email]);

            if (!$user) {
                return $this->redirectToRoute('app_register');
            }

            if ($user->getVerificationCode() === $code && $user->getVerificationCodeExpiresAt() > new \DateTimeImmutable()) {
                $user->setIsVerified(true);
                $user->setVerificationCode(null);
                $user->setVerificationCodeExpiresAt(null);
                $entityManager->flush();

                $request->getSession()->remove('pending_verification_email');
                $this->addFlash('success', 'Votre compte a été vérifié avec succès !');

                return $this->redirectToRoute('app_login');
            }

            $this->addFlash('error', 'Code invalide ou expiré.');
        }

        return $this->render('user/registration/verify_code.html.twig', [
            'email' => $email,
        ]);
    }
}
