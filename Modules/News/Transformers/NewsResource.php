<?php

namespace Modules\News\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'title' => $this->title,
            'image' => $this->featured_image,
            'content' => $this->content,
            'categories' => $this->categories->map(fn ($category) => [
                'id' => $category->hashId,
                'name' => $category->name,
            ]),
            'isPublished' => $this->status,
            'created_at' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'youtubeUrl' => $this->youtube_url,
        ];
    }
}
