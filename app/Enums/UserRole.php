<?php

namespace App\Enums;

use App\Enums\Concerns\HasOptions;

enum UserRole: int
{
    use HasOptions;

    case ADMIN = 0;
    case OPERATOR = 1;
    case SECURITY = 2;

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::OPERATOR => 'Operator',
            self::SECURITY => 'Security',
        };
    }
}
