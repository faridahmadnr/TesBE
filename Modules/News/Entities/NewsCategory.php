<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;

/**
 * Modules\News\Entities\NewsCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\News> $news
 * @property-read int|null $news_count
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withoutTrashed()
 *
 * @mixin \Eloquent
 */
class NewsCategory extends BaseModel
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
