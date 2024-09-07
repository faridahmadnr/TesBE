<?php

namespace Modules\Requirement\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RequirementResource extends JsonResource
{
    public function toArray($request)
    {
        $items = [
            'id' => $this->hashId,
            'name' => $this->name,
            'summary' => $this->summary,
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at,
            'image' => $this->image,
        ];

        return array_filter($items, fn ($value) => ! is_null($value) && $value !== '');
    }
}
