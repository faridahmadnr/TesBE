<?php

namespace Modules\Termin\Entities;

use App\Models\BaseModel;

/**
 * Modules\Termin\Entities\Termin
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withoutTrashed()
 * @mixin \Eloquent
 */
class Termin extends BaseModel
{
    protected $fillable = [
        'name',
        'value',
    ];
}
