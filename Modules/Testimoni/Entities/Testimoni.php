<?php

namespace Modules\Testimoni\Entities;

use App\Models\BaseModel;

class Testimoni extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_anonymous',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];
}
