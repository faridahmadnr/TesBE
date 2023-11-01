<?php

namespace Modules\BusinessPermit\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessPermitResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
