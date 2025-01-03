<?php

namespace Modules\Report\Transformers\External;

use App\Transformer\BaseTransformerCollection;
use Carbon\Carbon;

class ExternalAchivementRealizationCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item['hashId'],
            'year' => Carbon::parse($item['date'])->year,
            'target' => $item['target'],
            'realization' => $item['realization'],
        ];
    }
}
