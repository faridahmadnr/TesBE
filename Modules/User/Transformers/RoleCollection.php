<?php

namespace Modules\User\Transformers;

use App\Transformer\BaseTransformerCollection;

class RoleCollection extends BaseTransformerCollection
{
    protected function map(mixed $item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'description' => $item->description,
        ];
    }
}
