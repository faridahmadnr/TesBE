<?php

namespace Modules\Faq\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'question' => $this->question,
            'answer' => $this->answer,
            'createdAt' => $this->created_at,
        ];
    }
}
