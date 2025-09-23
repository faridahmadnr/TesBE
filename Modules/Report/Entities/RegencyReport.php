<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\Location\Entities\Regency;

/**
 * Modules\Report\Entities\RegencyReport
 *
 * @property int $id
 * @property int|null $regency_id
 * @property string $date
 * @property int $debtor
 * @property int $outstanding_value
 * @property int $realization
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $percentage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read CreditRequestType|null $creditRequestType
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read Regency|null $regency
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDebtor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereOutstandingValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport withoutTrashed()
 * @mixin \Eloquent
 */
class RegencyReport extends BaseModel
{
    protected $fillable = [
        'date',
        'regency_id',
        'debtor',
        'contract_value',
        'outstanding_value',
        'target',
        'realization',
        'percentage',
    ];

    /**
     * Set the base cache tags that will be present
     * on all queries.
     */
    protected function getCacheBaseTags(): array
    {
        return [
            'regency_report',
        ];
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function creditRequestType(): BelongsTo
    {
        return $this->belongsTo(CreditRequestType::class);
    }
}
