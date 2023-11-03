<?php

namespace Modules\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return ! is_null($user) && $user->can(PermissionsEnum::READ_USER->value);
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_USER->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_USER->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_USER->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_USER->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_USER->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_USER->value);
    }
}
