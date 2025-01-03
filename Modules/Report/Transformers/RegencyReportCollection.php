<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;
use Carbon\Carbon;

class RegencyReportCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        $item->load('regency');

        return [
            'id' => $item->hashId,
            'regency' => $item->whenLoaded('regency', $item->regency->name),
            'kurType' => $item->whenLoaded('creditRequestType', $item->creditRequestType->name),
            'quarter' => Carbon::parse($item->date)->quarter,
            'debtor' => $item->debtor,
            'submission' => $item->target,
            'submissionText' => formatCurrency($item->target),
            'realization' => $item->realization,
            'realizationText' => formatCurrency($item->realization),
            'createdAt' => $item->created_at,
            'updatedAt' => $item->updated_at,
        ];
    }
}
