<?php

namespace Modules\Bank\Transformers;

use App\Transformer\BaseTransformerCollection;

class BankCollection extends BaseTransformerCollection
{
    /**
     * Maps an item to an array.
     *
     * @param  mixed  $item The item to be mapped.
     * @return array The mapped array.
     */
    protected function map(mixed $item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'code' => $item->code,
            'logo' => $item->logo,
            'link' => $item->link,
            'isActive' => (bool) $item->status,
            'createdAt' => $item->created_at,
        ];
    }
}
