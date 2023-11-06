<?php

namespace Modules\CreditRequest\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class CreditRequestTypePolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_CREDIT_REQUEST_TYPE->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_CREDIT_REQUEST_TYPE->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_CREDIT_REQUEST_TYPE->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_CREDIT_REQUEST_TYPE->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_CREDIT_REQUEST_TYPE->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_CREDIT_REQUEST_TYPE->value);
    }
}
