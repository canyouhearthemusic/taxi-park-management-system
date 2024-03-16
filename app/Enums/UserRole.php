<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 0;
    case OPERATOR = 1;
    case SECURITY = 2;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::OPERATOR => 'operator',
            self::SECURITY => 'security',
        };
    }
}
