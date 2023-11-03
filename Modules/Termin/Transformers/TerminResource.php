<?php

namespace Modules\Termin\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TerminResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'value' => $this->value,
            'createdAt' => $this->created_at,
        ];
    }
}
