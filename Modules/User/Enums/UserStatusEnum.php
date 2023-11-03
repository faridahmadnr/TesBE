<?php

namespace Modules\User\Enums;

enum UserStatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case BLOCK = 2;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::BLOCK => 'Blocked',
        };
    }
}
