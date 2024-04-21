<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends BaseModel
{
    protected $fillable = [
        'province_id',
        'name',
    ];

    /**
     * Retrieves the province associated with this model.
     *
     * @return BelongsTo<Province, Regency> The province relationship.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Retrieves the districts associated with this model.
     *
     * @return HasMany<District> The hasMany relation.
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
