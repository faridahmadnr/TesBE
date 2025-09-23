<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

/**
 * Modules\Report\Entities\QuinquennialReport
 *
 * @property int $id
 * @property string $date
 * @property int|null $debitor
 * @property int|null $realization
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
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereDebitor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereRealization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|QuinquennialReport withoutTrashed()
 * @mixin \Eloquent
 */
class QuinquennialReport extends BaseModel
{
    protected $fillable = [
        'debitor',
        'realization',
        'date',
    ];

    /**
     * Set the base cache tags that will be present
     * on all queries.
     */
    protected function getCacheBaseTags(): array
    {
        return [
            'quinquennial_report',
        ];
    }
}
