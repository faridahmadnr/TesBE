<?php

namespace Modules\Termin\Entities;

use App\Models\BaseModel;

/**
 * Modules\Termin\Entities\Termin
 *
 * @property int $id
 * @property string $name
 * @property int $value
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
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withoutTrashed()
 * @mixin IdeHelperTermin
 * @mixin \Eloquent
 */
class Termin extends BaseModel
{
    protected $fillable = [
        'name',
        'value',
    ];
}
