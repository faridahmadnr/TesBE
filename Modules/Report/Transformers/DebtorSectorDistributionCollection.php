<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class DebtorSectorDistributionCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'name' => $item['name'],
            // 'debtor' => $item['debtor'],
            // 'contract' => $item['contract'],
            // 'target' => $item['target'],

            'debtor' => rand(0, 100),
            'contract' => rand(0, 100),
            'contractText' => formatCurrency(rand(0, 100)),
            'target' => rand(0, 100),
            'targetText' => formatCurrency(rand(0, 100)),
        ];
    }
}
