<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class AutoAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    public function supports(Request $request): ?bool
    {
        // Always support, effectively bypassing login for all routes
        // prevent loop on logout but allow re-login immediately
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        // We'll use a hardcoded email for the default user
        $email = 'admin@lifeops.com';

        return new SelfValidatingPassport(new UserBadge($email));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // Let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // Should never happen if user exists, but if it does, 
        // we could die or redirect. 
        // For dev purposes, let's just let it fail naturally (401)
        return new Response('Authentication Failed: ' . $exception->getMessage(), 401);
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        // If we need to start authentication, just redirect to dashboard/home which will trigger supports() -> authenticate()
        // Or returning a 401 is also valid if we don't want to redirect loops.
        // But since supports() returns true, this shouldn't be hit often unless credentials fail.
        return new Response('Authentication Required', 401);
    }
}
