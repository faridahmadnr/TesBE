<?php

namespace Modules\User\Transformers;

use App\Transformer\BaseTransformerCollection;

class UserCollection extends BaseTransformerCollection
{
    public function toArray($request)
    {
        return [
            'items' => $this->collection->transform(function ($item) {
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
            }),
            'itemsCount' => $this->count(),
            'itemsPerPage' => $this->perPage(),
        ];
    }
}
