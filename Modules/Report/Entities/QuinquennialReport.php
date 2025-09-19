<?php

namespace Modules\Report\Entities;

use App\Models\BaseModel;

/**
 * Modules\Report\Entities\QuinquennialReport
 *
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
