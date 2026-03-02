<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(private RouterInterface $router)
    {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): ?Response
    {
        $user = $token->getUser();

        // Check if user has ROLE_ADMIN
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            // Redirect admin to admin dashboard
            return new RedirectResponse($this->router->generate('admin'));
        }

        // Redirect regular users to user dashboard
        return new RedirectResponse($this->router->generate('app_dashboard'));
    }
}
