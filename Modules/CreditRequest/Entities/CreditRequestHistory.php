<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\CreditRequest\Entities\CreditRequestHistory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequest|null $creditRequest
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory withoutTrashed()
 * @mixin \Eloquent
 */
class CreditRequestHistory extends BaseModel
{
    protected $fillable = [
        'credit_request_id',
        'status',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Retrieves the related credit history model.
     *
     * @return BelongsTo<CreditRequest, CreditRequestHistory> The related Regency model.
     */
    public function creditRequest(): BelongsTo
    {
        return $this->belongsTo(CreditRequest::class);
    }
}
