<?php

namespace Modules\News\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'slug' => $this->slug,
            'createdAt' => $this->created_at,
            'deletedAt' => $this->deleted_at,
        ];
    }
}
