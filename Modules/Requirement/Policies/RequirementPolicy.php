<?php

namespace Modules\Requirement\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class RequirementPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_CREDIT_REQUEST_REQUIREMENT->value);
    }

    public function create(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_CREDIT_REQUEST_REQUIREMENT->value);
    }

    public function update(User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_CREDIT_REQUEST_REQUIREMENT->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_CREDIT_REQUEST_REQUIREMENT->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_CREDIT_REQUEST_REQUIREMENT->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_CREDIT_REQUEST_REQUIREMENT->value);
    }
}
