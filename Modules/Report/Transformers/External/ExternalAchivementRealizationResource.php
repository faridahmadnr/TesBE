<?php

namespace Modules\Report\Transformers\External;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class ExternalAchivementRealizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'year' => $this->date instanceof DateTime ? $this->date->format('Y') : date('Y', strtotime($this->date)),
            'target' => $this->target,
            'realization' => $this->realization,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
