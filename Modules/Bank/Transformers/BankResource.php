<?php

namespace Modules\Bank\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'name' => $this->name,
            'code' => $this->code,
            'createdAt' => $this->created_at,
            'logo' => $this->logo,
            'isActive' => (bool) $this->status,
            'link' => $this->link,
        ];
    }
}
