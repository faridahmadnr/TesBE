<?php

namespace App\Enums;

enum RolesEnum: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case ADMIN_OJK = 'admin-ojk';
    case ADMIN_BANK = 'admin-bank';
    case SUB_ADMIN_BANK = 'sub-admin-bank';
    case SUPERVISOR = 'supervisor';
    case MEMBER = 'member';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Administrator',
            self::ADMIN_OJK => 'Admin OJK',
            self::ADMIN_BANK => 'Admin Bank',
            self::SUB_ADMIN_BANK => 'Sub Admin Bank',
            self::SUPERVISOR => 'Supervisor',
            self::MEMBER => 'Member'
        };
    }
}
