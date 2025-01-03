<?php

namespace Modules\BusinessPermit\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessPermitResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'created_at' => $this->created_at,
        ];
    }
}
