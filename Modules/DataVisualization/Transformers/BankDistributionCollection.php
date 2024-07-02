<?php

namespace Modules\DataVisualization\Transformers;

use App\Transformer\BaseTransformerCollection;

class BankDistributionCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'name' => $item['name'],
            'logo' => $item['logo'],
            'potentialDebtor' => $item['potentialDebtor'],
            'debtor' => $item['debtor'],
            'transaction' => $item['transaction'],
            'realizationMark' => $item['realizationMark'],
            'realizationRate' => $item['realizationRate'],
        ];
    }
}

