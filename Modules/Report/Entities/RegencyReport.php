<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Location\Entities\Regency;

class RegencyReport extends BaseModel
{

    protected $fillable = [
        'date',
        'regency_id',
        'debtor',
        'contract_value',
        'outstanding_value',
        'target',
        'realization'
    ];

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }
}
