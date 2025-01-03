<?php

namespace Modules\Requirement\Transformers;

use App\Transformer\BaseTransformerCollection;

class RequirementCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return new RequirementResource($item);
    }
}
