<?php

namespace Modules\Faq\Transformers;

use App\Transformer\BaseTransformerCollection;

class FaqCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return new FaqResource($item);
    }
}
