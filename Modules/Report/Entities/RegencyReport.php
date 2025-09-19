<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\Location\Entities\Regency;

/**
 * Modules\Report\Entities\RegencyReport
 *
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
