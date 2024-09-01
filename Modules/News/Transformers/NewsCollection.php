<?php

namespace Modules\News\Transformers;

use App\Transformer\BaseTransformerCollection;

class NewsCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        $item->loadMissing(['categories']);

        return [
            'id' => $item->hashId,
            'title' => $item->title,
            'slug' => $item->slug,
            'image' => $item->featured_image,
            'content' => $item->summary,
            'categories' => $item->categories->pluck('name')->join(','),
            'isPublished' => $item->status,
            'createdAt' => $item->created_at,
            'updatedAt' => $item->updated_at,
            'summary' => $item->summary,
        ];
    }
}
