<?php

namespace Modules\BusinessPermit\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class BusinessPermitPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_BUSINESS_PERMIT->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_BUSINESS_PERMIT->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_BUSINESS_PERMIT->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BUSINESS_PERMIT->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_BUSINESS_PERMIT->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BUSINESS_PERMIT->value);
    }
}
