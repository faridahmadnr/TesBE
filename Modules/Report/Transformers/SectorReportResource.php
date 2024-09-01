<?php

namespace Modules\Report\Transformers;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'businessType' => $this->whenLoaded('businessType', [
                'id' => $this->businessType->hashId,
                'name' => $this->businessType->name,
            ]),
            'month' => $this->date instanceof DateTime ? $this->date->format('n') : date('n', strtotime($this->date)),
            'year' => $this->date instanceof DateTime ? $this->date->format('Y') : date('Y', strtotime($this->date)),
            'debtor' => $this->debtor,
            'contractValue' => $this->contract_value,
            'outstandingValue' => $this->outstanding_value,
            'target' => $this->target,
            'realization' => $this->realization,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
