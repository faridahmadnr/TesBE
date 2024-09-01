<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class RegencyReportCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        $item->load('regency');

        return [
            'id' => $item->hashId,
            'regency' => $item->whenLoaded('regency', $item->regency->name),
            'month' => date('n', strtotime($item->date)),
            'year' => date('Y', strtotime($item->date)),
            'debtor' => $item->debtor,
            'contractValue' => $item->contract_value,
            'outstandingValue' => $item->outstanding_value,
            'target' => $item->target,
            'realization' => $item->realization,
            'createdAt' => $item->created_at,
            'updatedAt' => $item->updated_at,
        ];
    }
}
