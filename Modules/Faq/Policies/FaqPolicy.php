<?php

namespace Modules\Faq\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class FaqPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_FAQ->value);
    }

    public function create(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_FAQ->value);
    }

    public function update(User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_FAQ->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_FAQ->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_FAQ->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_FAQ->value);
    }
}
