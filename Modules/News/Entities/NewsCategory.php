<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;

/**
 * Modules\News\Entities\NewsCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\News> $news
 * @property-read int|null $news_count
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withoutTrashed()
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
