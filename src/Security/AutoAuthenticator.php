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
<<<<<<< HEAD
    public function supports(Request $request): ?bool
    {
        // Always support, effectively bypassing login for all routes
        // prevent loop on logout but allow re-login immediately
        return true; 
=======
    
    
    public function supports(Request $request): ?bool
    {
        
        return false;
>>>>>>> ebaffe1c (first commit)
    }

    public function authenticate(Request $request): Passport
    {
<<<<<<< HEAD
        // Hardcode the user we created earlier
=======
>>>>>>> ebaffe1c (first commit)
        return new SelfValidatingPassport(new UserBadge('admin@lifeops.com'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
<<<<<<< HEAD
        // Let the request continue
=======
>>>>>>> ebaffe1c (first commit)
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
<<<<<<< HEAD
        // Should never happen if user exists, but if it does, 
        // we could die or redirect. 
        // For dev purposes, let's just let it fail naturally (401)
=======
>>>>>>> ebaffe1c (first commit)
        return new Response('Authentication Failed: '.$exception->getMessage(), 401);
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
<<<<<<< HEAD
        // If we need to start authentication, just redirect to dashboard/home which will trigger supports() -> authenticate()
        // Or returning a 401 is also valid if we don't want to redirect loops.
        // But since supports() returns true, this shouldn't be hit often unless credentials fail.
=======
>>>>>>> ebaffe1c (first commit)
        return new Response('Authentication Required', 401);
    }
}
