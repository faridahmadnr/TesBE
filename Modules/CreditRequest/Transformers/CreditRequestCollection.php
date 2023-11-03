<?php

namespace Modules\CreditRequest\Transformers;

use App\Transformer\BaseTransformerCollection;

class CreditRequestCollection extends BaseTransformerCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
