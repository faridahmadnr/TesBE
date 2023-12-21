<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;
use Mews\Purifier\Casts\CleanHtml;

/**
 * Modules\News\Entities\News
 *
 * @mixin IdeHelperNews
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property array $content
 * @property string|null $summary
 * @property string|null $featured_image
 * @property bool $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\NewsCategory> $categories
 * @property-read int|null $categories_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read \App\Models\?string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News withoutTrashed()
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

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_has_categories', 'news_id', 'category_id');
    }
}
