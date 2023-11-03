<?php

namespace Modules\Termin\Entities;

use App\Models\BaseModel;

class Termin extends BaseModel
{
    protected $fillable = [
        'name',
        'value',
    ];
}
