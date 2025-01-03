<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class SectorLendingDistributionCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'name' => $item['name'],
            'debtor' => $item['debtor'],
            'realization' => $item['realization'],
            'target' => $item['target'],
            'submissionAmount' => floatval($item['submission_amount']),
            'submissionAmountText' => formatCurrency($item['submission_amount']),
            'realizationAmount' => floatval($item['realization_amount']),
            'realizationAmountText' => formatCurrency($item['realization_amount']),
        ];
    }
}
