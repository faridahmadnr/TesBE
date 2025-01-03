<?php

namespace Modules\News\Transformers;

use App\Transformer\BaseTransformerCollection;

class NewsCategoryCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return new NewsCategoryResource($item);
    }
}
