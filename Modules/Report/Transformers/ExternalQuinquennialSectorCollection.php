<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;
use Carbon\Carbon;

class ExternalQuinquennialSectorCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item['hashId'],
            'year' => Carbon::parse($item['date'])->year,
            'debitor' => $item['debitor'],
            'realization' => $item['realization'],
        ];
    }
}
