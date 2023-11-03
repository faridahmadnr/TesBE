<?php

namespace Modules\Location\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'regencies' => $this->whenLoaded('regencies', function () {
                return $this->regencies->map(fn ($item) => [
                    'id' => $item->hashId,
                    'name' => $item->name,
                ]);
            }),
        ];
    }
}
