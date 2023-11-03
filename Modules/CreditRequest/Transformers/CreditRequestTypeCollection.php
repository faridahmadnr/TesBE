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
            'minValue' => $item->min_value,
            'maxValue' => $item->max_value,
            'createdAt' => $item->created_at,
        ];
    }
}
