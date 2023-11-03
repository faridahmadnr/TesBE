<?php

namespace Modules\CreditRequest\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditRequestTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'minValue' => $this->min_value,
            'maxValue' => $this->max_value,
            'createdAt' => $this->created_at,
        ];
    }
}
