<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

/**
 * Modules\Report\Entities\QuinquennialReport
 *
 * @property int $id
 * @property string $date
 * @property int $debitor
 * @property int $realization
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read CreditRequestType|null $creditRequestType
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read Regency|null $regency
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereCreditRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDebtor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|RegencyReport withoutTrashed()
 *
 * @mixin \Eloquent
 */
class QuinquennialReport extends BaseModel
{
    protected $fillable = [
        'debitor',
        'realization',
        'date',
    ];
}
