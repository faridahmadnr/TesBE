<?php

namespace Modules\BusinessType\Entities;

use App\Models\BaseModel;
use Modules\BusinessType\Database\factories\BusinessTypeFactory;

class BusinessType extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return BusinessTypeFactory::new();
    }
}
