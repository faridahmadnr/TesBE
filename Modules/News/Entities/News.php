<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;
use Mews\Purifier\Casts\CleanHtml;

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
