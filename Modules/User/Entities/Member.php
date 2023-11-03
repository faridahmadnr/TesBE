<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;

class Member extends BaseModel
{
    protected $fillable = [
        'nik',
        'phone',
        'address',
        'second_phone',
        'gender',
        'dob',
        'photo',
    ];
}
