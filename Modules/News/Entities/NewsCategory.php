<?php

namespace Modules\News\Entities;

use App\Models\BaseModel;

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
