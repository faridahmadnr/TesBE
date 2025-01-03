<?php

namespace Modules\Report\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class RegencyReportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'regency' => $this->regency->name ?? '-',
            'month' => date('n', strtotime($this->date)),
            'year' => date('Y', strtotime($this->date)),
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
