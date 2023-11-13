<?php

namespace Modules\CreditRequest\Transformers;

use App\Transformer\BaseTransformerCollection;

class CreditRequestTypeCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'interest' => $item->interest ?? 0,
            'minValue' => $item->min_value ?? 0,
            'maxValue' => $item->max_value ?? 0,
            'createdAt' => $item->created_at,
        ];
    }
}
