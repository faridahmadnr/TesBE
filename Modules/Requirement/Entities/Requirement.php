<?php

namespace Modules\Requirement\Entities;

use App\Models\BaseModel;

/**
 * Modules\Requirement\Entities\Requirement
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read mixed $image
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement withoutTrashed()
 * @mixin \Eloquent
 */
class Requirement extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'summary',
        'image',
        'status',
    ];

    public $imagePath = 'requirements/';

    public function getImageAttribute(?string $value)
    {
        return $this->getUploadPath($this->imagePath, $value);
    }
}
