<?php

namespace App\Security;

use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof Utilisateur) {
            return;
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAccountStatusException('Votre compte n\'est pas encore vérifié. Veuillez vérifier vos emails.');
        }

        if ($user->isBanned()) {
            $banUntil = $user->getBanUntil()->format('d/m/Y H:i');
            throw new CustomUserMessageAccountStatusException(sprintf('Votre compte est suspendu pour non-respect des règles de la communauté jusqu\'au %s.', $banUntil));
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // No post-auth check needed for now
    }
}
