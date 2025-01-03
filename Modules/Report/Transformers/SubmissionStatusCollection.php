<?php

namespace Modules\Report\Transformers;

use App\Transformer\BaseTransformerCollection;

class SubmissionStatusCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        $isRegion = isset(request()->filter['type']) && request()->filter['type'] == 'region';
        $isKurType = isset(request()->filter['type']) && request()->filter['type'] == 'kurType';

        $item['name'] = ucwords($item['name']);
        $item['realization'] = formatCurrency($item['realization']);
        if ($isRegion) {
            $item['submission'] = formatCurrency($item['submission']);
        }
        if ($isKurType) {
            $item['potential'] = $item['potential'];
        }

        return parent::map($item);
    }
}
