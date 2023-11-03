<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;

class CreditRequestType extends BaseModel
{
    protected $fillable = [
        'name',
        'min_value',
        'max_value',
    ];
}
