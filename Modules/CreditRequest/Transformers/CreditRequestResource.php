<?php

namespace Modules\CreditRequest\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;

class CreditRequestResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->hashId ?? '-',
            'amount' => intval($this->amount),
            'bank' => $this->whenLoaded('bank', $this->bank ? [
                'id' => $this->bank->hashId,
                'name' => $this->bank->name,
            ] : null),
            'business' => [
                'address' => $this->business_address,
                'district' => $this->whenLoaded('district', [
                    'id' => $this->district->hashId,
                    'name' => $this->district->name,
                ]),
                'permit' => $this->whenLoaded('businessPermit', [
                    'id' => $this->businessPermit->hashId ?? '-',
                    'name' => $this->businessPermit->name ?? '-',
                ], [
                    'id' => '-',
                    'name' => '-',
                ]),
                'regency' => $this->whenLoaded('regency', [
                    'id' => $this->regency->hashId,
                    'name' => $this->regency->name,
                ]),
                'business_tin' => $this->business_tin,
                'type' => $this->whenLoaded('businessType', [
                    'id' => $this->businessType->hashId,
                    'name' => $this->businessType->name,
                ]),
            ],
            'createdAt' => $this->created_at,
            'type' => $this->whenLoaded('creditRequestType', [
                'id' => $this->creditRequestType->hashId,
                'name' => $this->creditRequestType->name,
            ]),
            'postalCode' => $this->postal_code,
            'registrationNumber' => trim($this->registration_number),
            'termin' => $this->whenLoaded('termin', [
                'id' => $this->termin->hashId,
                'name' => $this->termin->name,
            ]),
            'village' => $this->village,
            'user' => $this->whenLoaded('user', $this->user ? [
                'id' => $this->user->hashId,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone_1' => $this->user->member->phone ?? '-',
                'phone_2' => $this->user->member->second_phone ?? '-',
                'identityNumber' => $this->user->member->identity_number ?? '-',
                'gender' => $this->user->member->gender ?? '-',
                'address' => $this->user->member->address ?? '-',
                'dob' => $this->user->member->dob ?? '-',
                'isDeleted' => ! is_null($this->user->deleted_at),
            ] : null),
            'status' => strtolower(CreditRequestStatusEnum::from($this->status)->name),
            'history' => $this->whenLoaded('histories', $this->histories->map(function ($history) {
                return [
                    'id' => $history->hashId,
                    'message' => $history->description,
                    'createdAt' => $history->created_at,
                ];
            })),
        ];
    }
}
