<?php

namespace Modules\Report\Transformers\External;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ExternalRegionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'year' => $this->date instanceof DateTime ? $this->date->format('Y') : date('Y', strtotime($this->date)),
            'regency' => $this->whenLoaded('regency', [
                'id' => $this->regency->hashId,
                'name' => $this->regency->name,
            ]),
            'debitor' => $this->debtor,
            'realization' => $this->realization,
            'percentage' => $this->percentage,
            'outstanding' => $this->outstanding_value,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
