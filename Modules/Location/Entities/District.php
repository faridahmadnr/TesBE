<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends BaseModel
{
    protected $fillable = [
        'name',
        'regency_id',
    ];

    /**
     * Retrieve the related Regency model.
     *
     * @return BelongsTo<Regency, District> The related Regency model.
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
}
