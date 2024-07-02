<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BusinessType\Entities\BusinessType;

/**
 * Modules\Report\Entities\SectorReport
 *
 * @property int $id
 * @property int|null $business_type_id
 * @property string $date
 * @property int $debtor_value
 * @property int $contract_value
 * @property int $outstanding_value
 * @property int $target
 * @property int $realization
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read BusinessType|null $businessType
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read mixed $month
 * @property-read mixed $year
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereBusinessTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereContractValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereDebtorValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereOutstandingValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport withoutTrashed()
 *
 * @mixin \Eloquent
 */
class SectorReport extends BaseModel
{
    protected $fillable = [
        'date',
        'business_type_id',
        'debtor',
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
