<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            'id' => $this->hashId,
            'email' => $this->email,
        ];
    }
}
