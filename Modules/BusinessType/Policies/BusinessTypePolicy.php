<?php

namespace Modules\BusinessType\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class BusinessTypePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_BUSINESS_TYPE->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_BUSINESS_TYPE->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_BUSINESS_TYPE->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BUSINESS_TYPE->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_BUSINESS_TYPE->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BUSINESS_TYPE->value);
    }
}
