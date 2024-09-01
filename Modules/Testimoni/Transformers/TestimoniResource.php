<?php

namespace Modules\Testimoni\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimoniResource extends JsonResource
{
    public function toArray($request)
    {
        $items = [
            'id' => $this->hashId,
            'name' => $this->name,
            'email' => $this->email ?? '',
            'message' => $this->message,
            'isAnonymous' => $this->is_anonymous,
            'createdAt' => $this->created_at,
            'image' => $this->image ?? '',
        ];

        return array_filter($items, fn ($value) => ! is_null($value) && $value !== '');
    }
}
