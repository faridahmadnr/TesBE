<?php

namespace Modules\Report\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SectorReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'businessType' => $this->whenLoaded('businessType', $this->businessType->name),
            'month' => $this->month,
            'year' => $this->year,
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
