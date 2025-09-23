<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modules\CreditRequest\Entities\CreditRequestHistory
 *
 * @property int $id
 * @property int $credit_request_id
 * @property int $status
 * @property string $description
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequest $creditRequest
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreditRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereUpdatedBy($value)
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
