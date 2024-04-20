<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;

class SectorReport extends BaseModel
{
    protected $fillable = [
        'date',
        'business_type_id',
        'debtor',
        'contract_value',
        'outstanding_value',
        'target',
        'realization'
    ];


    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }


}
