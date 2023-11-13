<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;

/**
 * Modules\CreditRequest\Entities\CreditRequestType
 *
 * @property int $id
 * @property string $name
 * @property int $min_value
 * @property int $max_value
 * @property float $interest
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class CreditRequestType extends BaseModel
{
    protected $fillable = [
        'name',
        'min_value',
        'max_value',
        'interest',
    ];
}
