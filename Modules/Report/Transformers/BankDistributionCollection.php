<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class BankDistributionCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'name' => $item['name'],
            'logo' => $item['logo'],
            'potentialDebtor' => $item['potential'],
            'debtor' => $item['debtor'],
            'transaction' => $item['transaction'],
            'realizationMark' => formatCurrency(intval($item['realization'])),
            'realizationRate' => floatval($item['rate']),
        ];
    }
}
