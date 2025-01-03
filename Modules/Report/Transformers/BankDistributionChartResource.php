<?php

namespace Modules\Report\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BankDistributionChartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'items' => $this->resource,
        ];
    }
}
