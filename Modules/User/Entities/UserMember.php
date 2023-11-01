<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMember extends BaseModel
{
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserMemberFactory::new();
    }
}
