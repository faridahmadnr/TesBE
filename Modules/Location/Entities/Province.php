<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;

/**
 * Modules\Location\Entities\Province
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
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Province withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Province extends BaseModel
{
    protected $fillable = [];
}
