<?php

namespace Modules\BusinessType\Transformers;

use App\Transformer\BaseTransformerCollection;

class BusinessTypeCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'createdAt' => $item->created_at,
        ];
    }
}
