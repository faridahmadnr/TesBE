<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Download
 *
 * @property int $id
 * @property string $code
 * @property string $path
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static Builder|Download newModelQuery()
 * @method static Builder|Download newQuery()
 * @method static Builder|Download onlyTrashed()
 * @method static Builder|Download query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static Builder|Download whereCode($value, $field = null)
 * @method static Builder|Download whereCreatedAt($value)
 * @method static Builder|Download whereId($value)
 * @method static Builder|Download wherePath($value)
 * @method static Builder|Download whereType($value)
 * @method static Builder|Download whereUpdatedAt($value)
 * @method static Builder|Download withTrashed()
 * @method static Builder|Download withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Download extends BaseModel
{
    protected $fillable = [
        'code',
        'path',
        'type',
    ];

    /**
     * Get the value of the model's route key.
     */
    public function getRouteKey(): string
    {
        return 'code';
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field !== null) {
            return parent::resolveRouteBinding($value, $field);
        }

        return $this->whereCode($value)->firstOrFail();
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        return $query->whereCode($field ?? $this->getRouteKeyName(), $value);
    }
}
