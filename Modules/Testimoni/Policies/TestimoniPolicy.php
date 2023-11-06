<?php

namespace Modules\Testimoni\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class TestimoniPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_TESTIMONI->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_TESTIMONI->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_TESTIMONI->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_TESTIMONI->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_TESTIMONI->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_TESTIMONI->value);
    }
}
