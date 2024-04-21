<?php

namespace Modules\BusinessPermit\Entities;

use App\Models\BaseModel;

/**
 * Modules\BusinessPermit\Entities\BusinessPermit
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit withoutTrashed()
 * @mixin \Eloquent
 */
class BusinessPermit extends BaseModel
{
    protected $fillable = [
        'name',
    ];
}
