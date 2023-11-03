<?php

namespace Modules\Location\Transformers;

use App\Transformer\BaseTransformerCollection;

class DistrictCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
        ];
    }
}
