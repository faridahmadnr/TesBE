<?php

namespace Modules\User\Transformers;

use App\Transformer\BaseTransformerCollection;

class UserCollection extends BaseTransformerCollection
{
    public function toArray($request)
    {
        return [
            'items' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->hashId,
                    'email' => $item->email,
                ];
            }),
            'itemsCount' => $this->count(),
            'itemsPerPage' => $this->perPage(),
        ];
    }
}
