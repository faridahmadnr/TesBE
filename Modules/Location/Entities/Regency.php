<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modules\Location\Entities\Regency
 *
 * @property int $id
 * @property int $province_id
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Location\Entities\District> $districts
 * @property-read int|null $districts_count
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\Location\Entities\Province $province
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency withoutTrashed()
 * @mixin IdeHelperRegency
 * @mixin \Eloquent
 */
class Regency extends BaseModel
{
    protected $fillable = [
        'province_id',
        'name',
    ];

    /**
     * Retrieves the province associated with this model.
     *
     * @return BelongsTo<Province, Regency> The province relationship.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Retrieves the districts associated with this model.
     *
     * @return HasMany<District> The hasMany relation.
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
