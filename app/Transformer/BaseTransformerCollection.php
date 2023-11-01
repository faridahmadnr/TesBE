<?php

namespace App\Transformer;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * PaginationCollection
 *
 * @method string|int total()
 * @method string|int perPage()
 * @method string|int currentPage()
 **/
class BaseTransformerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'itemsCount' => $this->count(),
            'itemsPerPage' => $this->perPage(),
        ];
    }
}
