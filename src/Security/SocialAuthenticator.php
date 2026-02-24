<?php

namespace App\Security;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SocialAuthenticator extends OAuth2Authenticator
{
    use TargetPathTrait;

    private ClientRegistry $clientRegistry;
    private EntityManagerInterface $entityManager;
    private RouterInterface $router;

    public function __construct(ClientRegistry $clientRegistry, EntityManagerInterface $entityManager, RouterInterface $router)
    {
        $this->clientRegistry = $clientRegistry;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        return in_array($request->attributes->get('_route'), [
            'connect_google_check',
            'connect_facebook_check',
            'connect_github_check'
        ]);
    }

    public function authenticate(Request $request): Passport
    {
        $clientName = str_replace(['connect_', '_check'], '', $request->attributes->get('_route'));
        $client = $this->clientRegistry->getClient($clientName);
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function() use ($accessToken, $client, $clientName) {
                $socialUser = $client->fetchUserFromToken($accessToken);
                $email = $socialUser->getEmail();

                // 1) Find user by social id
                $field = $clientName . 'Id'; // e.g. googleId
                $user = $this->entityManager->getRepository(Utilisateur::class)->findOneBy([$field => $socialUser->getId()]);

                if ($user) {
                    return $user;
                }

                // 2) Find user by email
                $user = $this->entityManager->getRepository(Utilisateur::class)->findOneBy(['email' => $email]);

                if (!$user) {
                    // 3) Create new user
                    $user = new Utilisateur();
                    $user->setEmail($email);
                    $user->setNom($socialUser->toArray()['name'] ?? ($socialUser->toArray()['login'] ?? 'Social User'));
                    $user->setPrenom('');
                    $user->setIsVerified(true);
                    $user->setRole('ROLE_USER');
                    $user->setHasSetPassword(false);
                    // Random password for social users
                    $user->setPassword(bin2hex(random_bytes(16)));
                }

                // Ensure social users are always verified
                $user->setIsVerified(true);

                // Link social account
                $setter = 'set' . ucfirst($field);
                $user->$setter($socialUser->getId());

                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $request->getSession()->getFlashBag()->add('success', 'Connexion réussie avec votre compte social !');

        $targetPath = $this->getTargetPath($request->getSession(), $firewallName);

        if ($targetPath) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->router->generate('app_time_index'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        $request->getSession()->getFlashBag()->add('error', $message);

        return new RedirectResponse($this->router->generate('app_login'));
    }
}
