<?php

namespace Modules\BusinessPermit\Transformers;

use App\Transformer\BaseTransformerCollection;

class BusinessPermitCollection extends BaseTransformerCollection
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
