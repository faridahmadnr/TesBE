<?php

namespace Modules\User\Transformers;

use App\Transformer\BaseTransformerCollection;

class RoleCollection extends BaseTransformerCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($role) {
            return [
                'id' => $role->hashId,
                'name' => $role->name,
                'description' => $role->description,
            ];
        });
    }
}
