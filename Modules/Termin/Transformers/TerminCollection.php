<?php

namespace Modules\Termin\Transformers;

use App\Transformer\BaseTransformerCollection;

class TerminCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'value' => $item->value,
            'createdAt' => $item->created_at,
        ];
    }
}
