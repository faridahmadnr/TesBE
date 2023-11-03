<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreditRequest extends BaseModel
{
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\CreditRequest\Database\factories\CreditRequestFactory::new();
    }
}
