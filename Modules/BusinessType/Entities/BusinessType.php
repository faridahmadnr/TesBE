<?php

namespace Modules\BusinessType\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessType extends BaseModel
{
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\BusinessType\Database\factories\BusinessTypeFactory::new();
    }
}
