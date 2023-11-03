<?php

namespace Modules\Testimoni\Transformers;

use App\Transformer\BaseTransformerCollection;

class TestimoniCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'email' => $item->email ?? '',
            'isAnonymous' => (bool) $item->is_anonymous,
            'createdAt' => $item->created_at,
        ];
    }
}
