<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BusinessType\Entities\BusinessType;

class SectorReport extends BaseModel
{
    protected $fillable = [
        'date',
        'business_type_id',
        'debtor_value',
        'contract_value',
        'outstanding_value',
        'target',
        'realization',
    ];

    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function getYearAttribute()
    {
        return date('Y', strtotime($this->date));
    }

    public function getMonthAttribute()
    {
        return date('n', strtotime($this->date));
    }
}
