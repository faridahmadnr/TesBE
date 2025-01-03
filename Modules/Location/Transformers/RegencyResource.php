<?php

namespace Modules\Location\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RegencyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'province' => [
                'id' => $this->province->hashId,
                'name' => ucwords(strtolower($this->province->name)),
            ],
            'districts' => $this->whenLoaded('districts', function () {
                return $this->districts->map(function ($district) {
                    return [
                        'id' => $district->hashId,
                        'name' => ucwords(strtolower($district->name)),
                    ];
                });
            }),
        ];
    }
}
