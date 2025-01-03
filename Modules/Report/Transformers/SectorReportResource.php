<?php

namespace Modules\Report\Transformers;

use Carbon\Carbon;
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
            'quarter' => Carbon::parse($this->date)->quarter,
            'debitor' => $this->debitor,
            'realization' => $this->realization,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
