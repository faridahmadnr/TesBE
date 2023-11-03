<?php

namespace Modules\Location\Transformers;

use App\Transformer\BaseTransformerCollection;

class RegencyCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
        ];
    }
}
