<?php

namespace Modules\Bank\Entities;

use App\Models\BaseModel;

class Bank extends BaseModel
{
    protected $fillable = [
        'name',
        'link',
        'code',
        'status',
        'reason_status',
        'logo',
    ];
}
