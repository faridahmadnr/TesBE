<?php

namespace Modules\User\Database\seeders;

use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Modules\User\Enums\PermissionsEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles
        $roles = collect(RolesEnum::cases())->map(function ($role) {
            return [
                'name' => $role->value,
                'description' => $role->label(),
                'guard_name' => 'web',
            ];
        })->toArray();

        Role::insert($roles);

        // create permissions
        $permissions = collect(PermissionsEnum::cases())->map(function ($permission) {
            return [
                'name' => $permission->value,
                'description' => $permission->label(),
                'guard_name' => 'web',
            ];
        })->toArray();

        Permission::insert($permissions);

        $superAdminRole = Role::findByName(RolesEnum::SUPER_ADMIN->value);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::findByName(RolesEnum::ADMIN->value);
        $adminRole->givePermissionTo(Permission::whereNotIn('name', [
            PermissionsEnum::CONFIRM_CREDIT_REQUEST->value,
            PermissionsEnum::APPROVE_CREDIT_REQUEST->value,
            PermissionsEnum::REJECT_CREDIT_REQUEST->value,
        ])->get());

        $adminBankRole = Role::findByName(RolesEnum::ADMIN_BANK->value);
        $adminBankRole->givePermissionTo([
            PermissionsEnum::CONFIRM_CREDIT_REQUEST,
            PermissionsEnum::APPROVE_CREDIT_REQUEST,
            PermissionsEnum::REJECT_CREDIT_REQUEST,
        ]);

        $memberRole = Role::findByName(RolesEnum::MEMBER->value);
        $memberRole->givePermissionTo([
            PermissionsEnum::CREATE_CREDIT_REQUEST,
            PermissionsEnum::READ_OWN_CREDIT_REQUEST,
            PermissionsEnum::UPDATE_PROFILE,
        ]);
    }
}
