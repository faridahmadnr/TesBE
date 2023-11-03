<?php

namespace Modules\User\Transformers;

use App\Transformer\BaseTransformerCollection;

class UserCollection extends BaseTransformerCollection
{
    /**
     * Maps an item to an array with specific keys.
     *
     * @param  mixed  $item The item to be mapped.
     * @return array The mapped array.
     */
    protected function map(mixed $item)
    {
        $role = $item->roles ? $item->roles->first() : null;

        return [
            'id' => $item->hashId,
            'name' => $item->name,
            'email' => $item->email,
            'createdAt' => $item->created_at,
            'status' => $item->status,
            'role' => $role ? $role->description : null,
            'bank' => $item->profile->bank ? $item->profile->bank->name : null,
        ];
    }
}
