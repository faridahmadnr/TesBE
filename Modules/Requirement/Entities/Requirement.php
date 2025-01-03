<?php

namespace Modules\Requirement\Entities;

use App\Models\BaseModel;

/**
 * Modules\Requirement\Entities\Requirement
 *
 * @property int $id
 * @property string $name
 * @property string $summary
 * @property string $description
 * @property string|null $image
 * @property int $status
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
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Requirement whereUpdatedBy($value)
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
