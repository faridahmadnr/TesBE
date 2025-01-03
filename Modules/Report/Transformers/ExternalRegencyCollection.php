<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;
use Carbon\Carbon;

class ExternalRegencyCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item['hashId'],
            'year' => Carbon::parse($item['date'])->year,
            'quarter' => Carbon::parse($item['date'])->quarter,
            'regency' => $item['regency']['name'] ?? '-',
            'debitor' => $item['debtor'] ?? 0,
            'realization' => $item['realization'] ?? 0,
            'outstanding' => $item['outstanding_value'] ?? 0,
            'percentage' => $item['percentage'] ?? 0,
        ];
    }
}
