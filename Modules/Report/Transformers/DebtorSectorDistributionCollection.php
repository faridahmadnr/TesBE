<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class DebtorSectorDistributionCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'name' => $item['name'],
            'target' => $item['target'],
            'realization' => $item['realization'],
            'targetText' => formatCurrency($item['target']),
            'realizationText' => formatCurrency($item['realization']),
        ];
    }
}
