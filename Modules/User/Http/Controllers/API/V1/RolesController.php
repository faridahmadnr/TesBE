<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Enums\RolesEnum;
use App\Http\Controllers\Controller as BaseController;
use Modules\User\Entities\Role;
use Modules\User\Transformers\RoleCollection;

class RolesController extends BaseController
{
    public function __invoke()
    {
        $roles = Role::all(['id', 'name', 'description'])
            ->where('name', '!=', RolesEnum::SUPER_ADMIN->value);

        return $this->okResponse(new RoleCollection($roles));
    }
}
