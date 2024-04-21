<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the regencies associated with the model.
     *
     * @return HasMany<Regency>
     */
    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }
}
