<?php

namespace Modules\BusinessType\Entities;

use App\Models\BaseModel;
use Modules\BusinessType\Database\factories\BusinessTypeFactory;

/**
 * Modules\BusinessType\Entities\BusinessType
 *
 * @property int $id
 * @property string $name
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
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class BusinessType extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return BusinessTypeFactory::new();
    }
}
