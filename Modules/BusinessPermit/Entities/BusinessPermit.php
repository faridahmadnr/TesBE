<?php

namespace Modules\BusinessPermit\Entities;

use App\Models\BaseModel;

/**
 * Modules\BusinessPermit\Entities\BusinessPermit
 *
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
