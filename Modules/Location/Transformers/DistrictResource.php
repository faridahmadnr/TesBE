<?php

namespace Modules\Location\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'regency' => $this->whenLoaded('regency', [
                'id' => $this->regency->hashId,
                'name' => $this->regency->name,
            ]),
        ];
    }
}
