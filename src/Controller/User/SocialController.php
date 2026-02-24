<?php

namespace App\Controller\User;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SocialController extends AbstractController
{
    #[Route('/connect/google', name: 'connect_google_start')]
    public function connectGoogleStart(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect([
                'email', 'profile'
            ], []);
    }

    #[Route('/connect/google/check', name: 'connect_google_check')]
    public function connectGoogleCheck(Request $request): Response
    {
        // This is handled by the Authenticator
        return new Response();
    }

    #[Route('/connect/facebook', name: 'connect_facebook_start')]
    public function connectFacebookStart(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('facebook')
            ->redirect([
                'public_profile', 'email'
            ], []);
    }

    #[Route('/connect/facebook/check', name: 'connect_facebook_check')]
    public function connectFacebookCheck(Request $request): Response
    {
        // This is handled by the Authenticator
        return new Response();
    }

    #[Route('/connect/github', name: 'connect_github_start')]
    public function connectGithubStart(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('github')
            ->redirect([
                'user', 'user:email'
            ], []);
    }

    #[Route('/connect/github/check', name: 'connect_github_check')]
    public function connectGithubCheck(Request $request): Response
    {
        // This is handled by the Authenticator
        return new Response();
    }
}
