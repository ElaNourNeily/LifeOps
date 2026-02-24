<?php

namespace App\Enum;

enum UserRole: string
{
    case USER = 'ROLE_USER';
    case ADMIN = 'ROLE_ADMIN';
    case GROUP = 'ROLE_GROUP';

    public function label(): string
    {
        return match($this) {
            self::USER => 'Utilisateur',
            self::ADMIN => 'Administrateur',
            self::GROUP => 'Groupe',
        };
    }

    public static function fromString(string $value): self
    {
        return self::tryFrom($value) ?? self::USER;
    }
}
