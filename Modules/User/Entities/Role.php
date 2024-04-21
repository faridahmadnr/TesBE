<?php

namespace Modules\User\Entities;

use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Deligoez\LaravelModelHashId\Traits\HasHashIdRouting;

class Role extends \Spatie\Permission\Models\Role
{
    use HasHashId, HasHashIdRouting;
}
