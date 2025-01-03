<?php

namespace Modules\News\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class NewsPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_BANK->value);
    }

    public function update(User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_BANK->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BANK->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_BANK->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_BANK->value);
    }
}
