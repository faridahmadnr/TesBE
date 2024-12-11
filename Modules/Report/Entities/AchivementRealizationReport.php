<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

/**
 * Modules\Report\Entities\AchivementRealizationReport
 *
 * @property int $id
 * @property int $target
 * @property int $realization
 * @property string $date
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
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AchivementRealizationReport withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AchivementRealizationReport extends BaseModel
{
    protected $fillable = [
        'date',
        'target',
        'realization',
    ];
}
