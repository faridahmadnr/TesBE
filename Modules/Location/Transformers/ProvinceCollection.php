<?php

namespace Modules\Location\Transformers;

use App\Transformer\BaseTransformerCollection;

class ProvinceCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
        ];
    }
}
