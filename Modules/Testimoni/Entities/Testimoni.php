<?php

namespace Modules\Testimoni\Entities;

use App\Models\BaseModel;

/**
 * Modules\Testimoni\Entities\Testimoni
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read mixed $image
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni withoutTrashed()
 * @mixin \Eloquent
 */
class Testimoni extends BaseModel
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_anonymous',
        'image',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public $imagePath = 'testimonials/';

    public function getImageAttribute(?string $value)
    {
        return $this->getUploadPath($this->imagePath, $value);
    }
}
