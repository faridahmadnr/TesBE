<?php

namespace Modules\BusinessType\Entities;

use App\Models\BaseModel;
use Modules\BusinessType\Database\factories\BusinessTypeFactory;
use Modules\Report\Entities\SectorReport;

/**
 * Modules\BusinessType\Entities\BusinessType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SectorReport> $sector
 * @property-read int|null $sector_count
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Modules\BusinessType\Database\factories\BusinessTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withoutTrashed()
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

    public function sector()
    {
        return $this->hasMany(SectorReport::class);
    }
}
