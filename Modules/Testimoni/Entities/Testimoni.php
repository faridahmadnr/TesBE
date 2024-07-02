<?php

namespace Modules\Testimoni\Entities;

use App\Models\BaseModel;

/**
 * Modules\Testimoni\Entities\Testimoni
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $message
 * @property string|null $image
 * @property bool $is_anonymous
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
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereIsAnonymous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereUpdatedBy($value)
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
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];
}
