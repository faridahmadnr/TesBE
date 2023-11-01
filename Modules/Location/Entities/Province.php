<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends BaseModel
{
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Location\Database\factories\ProvinceFactory::new();
    }
}
