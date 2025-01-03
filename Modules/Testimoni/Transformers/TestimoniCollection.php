<?php

namespace Modules\Testimoni\Transformers;

use App\Transformer\BaseTransformerCollection;

class TestimoniCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return new TestimoniResource($item);
    }
}
