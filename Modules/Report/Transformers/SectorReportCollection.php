<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;
use Carbon\Carbon;

class SectorReportCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        $item->load('businessType');

        return [
            'id' => $item->hashId,
            'businessType' => $item->whenLoaded('businessType', $item->businessType->name ?? '-'),
            'quarter' => Carbon::parse($item->date)->quarter,
            'submission' => $item->target,
            'submissionText' => formatCurrency($item->target),
            'realization' => $item->realization,
            'realizationText' => formatCurrency($item->realization),
            'createdAt' => $item->created_at,
            'updatedAt' => $item->updated_at,
        ];
    }
}
