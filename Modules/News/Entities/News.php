<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;

/**
 * Modules\News\Entities\News
 *
 * @property array $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\NewsCategory> $categories
 * @property-read int|null $categories_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read mixed $featured_image
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static Builder|News newModelQuery()
 * @method static Builder|News newQuery()
 * @method static Builder|News onlyTrashed()
 * @method static Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static Builder|News withTrashed()
 * @method static Builder|News withoutTrashed()
 * @mixin \Eloquent
 */
class News extends BaseModel
{
    protected $fillable = [
        'title',
        'content',
        'featured_image',
        'slug',
        'status',
        'summary',
    ];

    protected $casts = [
        'content' => CleanHtml::class,
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $imagePath = 'news/';

    public function getRouteKey(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field !== null) {
            return parent::resolveRouteBinding($value, $field);
        }

        return $this->whereSlug($value)->firstOrFail();
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        return $query->whereSlug($field ?? $this->getRouteKeyName(), $value);
    }

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_has_categories', 'news_id', 'category_id');
    }

    public function getFeaturedImageAttribute(?string $value)
    {
        return $this->getUploadPath($this->imagePath, $value);
    }
}
