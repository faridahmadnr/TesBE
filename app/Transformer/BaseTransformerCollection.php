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
            'items' => $this->collection->transform($this->map(...)),
            'itemsCount' => $this->total(),
            'itemsPerPage' => $this->perPage(),
        ];
    }

    /**
     * Maps an item.
     *
     * @param  mixed  $item The item to be mapped.
     * @return mixed The mapped item.
     */
    protected function map($item)
    {
        return $item;
    }
}
