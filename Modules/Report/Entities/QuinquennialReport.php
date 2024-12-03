<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

class QuinquennialReport extends BaseModel
{
    protected $fillable = [
        'debitor',
        'realization',
        'date',
    ];
}
