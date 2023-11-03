<?php

namespace Modules\Bank\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BankCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($bank) {
            return [
                'id' => $bank->hashId,
                'name' => $bank->name,
            ];
        });
    }
}
