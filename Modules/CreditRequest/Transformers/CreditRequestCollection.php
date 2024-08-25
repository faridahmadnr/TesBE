<?php

namespace Modules\CreditRequest\Transformers;

use App\Transformer\BaseTransformerCollection;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;

class CreditRequestCollection extends BaseTransformerCollection
{
    protected function map($item)
    {
        return [
            'id' => $item->hashId,
            'amount' => $item->amount,
            'business' => [
                'address' => $item->business_address,
                'district' => $item->whenLoaded('district', $item->district?->name),
                'type' => $item->whenLoaded('businessType', $item->businessType?->name),
            ],
            'registrationNumber' => trim($item->registration_number),
            'phone' => $item->user->member->phone ?? '',
            'creditRequestType' => $item->whenLoaded('creditRequestType', $item->creditRequestType?->name),
            'createdAt' => $item->created_at,
            'user' => $item->whenLoaded('user', $item->user->name ?? 'Deleted User'),
            'userIsDeleted' => $item->user?->deleted_at || ! $item->user ? true : false,
            'status' => strtolower(CreditRequestStatusEnum::from($item->status)->name),
        ];
    }
}
