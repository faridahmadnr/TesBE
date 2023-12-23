<?php

use App\Enums\RolesEnum;

it('has correct labels for each role', function ($role, $label) {
    expect($role->label())->toEqual($label);
})->with([
    [RolesEnum::SUPER_ADMIN, 'Super Admin'],
    [RolesEnum::ADMIN, 'Administrator'],
    [RolesEnum::ADMIN_OJK, 'Admin OJK'],
    [RolesEnum::ADMIN_BANK, 'Admin Bank'],
    [RolesEnum::SUB_ADMIN_BANK, 'Sub Admin Bank'],
    [RolesEnum::SUPERVISOR, 'Supervisor'],
    [RolesEnum::MEMBER, 'Member'],
]);

it('has correct values for each role', function ($role, $value) {
    expect($role->value)->toEqual($value);
})->with([
    [RolesEnum::SUPER_ADMIN, 'super-admin'],
    [RolesEnum::ADMIN, 'admin'],
    [RolesEnum::ADMIN_OJK, 'admin-ojk'],
    [RolesEnum::ADMIN_BANK, 'admin-bank'],
    [RolesEnum::SUB_ADMIN_BANK, 'sub-admin-bank'],
    [RolesEnum::SUPERVISOR, 'supervisor'],
    [RolesEnum::MEMBER, 'member'],
]);
