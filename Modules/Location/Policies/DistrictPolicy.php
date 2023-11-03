<?php

namespace Modules\Location\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class DistrictPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return true;
    }

    public function view(User $user)
    {
        return $user->can(PermissionsEnum::READ_LOCATION->value);
    }

    public function create($user)
    {
        return $user->can(PermissionsEnum::CREATE_LOCATION->value);
    }

    public function update(?User $user)
    {
        return $user->can(PermissionsEnum::UPDATE_LOCATION->value);
    }

    public function delete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_LOCATION->value);
    }

    public function restore(User $user)
    {
        return $user->can(PermissionsEnum::CREATE_LOCATION->value);
    }

    public function forceDelete(User $user)
    {
        return $user->can(PermissionsEnum::DELETE_LOCATION->value);
    }
}
