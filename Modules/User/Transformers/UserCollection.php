<?php

namespace Modules\User\Transformers;

use App\Enums\RolesEnum;
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
        $isMember = $item->hasRole(RolesEnum::MEMBER);

        $result = [
            'id' => $item->hashId,
            'name' => $item->name,
            'email' => $item->email,
            'createdAt' => $item->created_at,
            'deletedAt' => $item->deleted_at,
            'status' => $item->status ? 'active' : 'inactive',
            'role' => $role ? $role->description : null,
            'isVerified' => $item->email_verified_at !== null,
        ];

        if ($isMember) {
            return $this->resultMember($result, $item);
        }

        return $this->result($result, $item);
    }

    private function resultMember(array $result, $item)
    {
        return [
            ...$result,
            'identityNumber' => $item->whenLoaded('member', function () use ($item) {
                return $item->member->identity_number;
            }),
            'phone' => $item->whenLoaded('member', function () use ($item) {
                return $item->member->phone ?? $item->member->second_phone;
            }),
            'gender' => $item->whenLoaded('member', function () use ($item) {
                return $item->member->gender;
            }),
        ];
    }

    private function result(array $result, $item)
    {
        return [
            ...$result,
            'phone' => $item->whenLoaded('profile', function () use ($item) {
                return $item->profile->phone;
            }),
            'bank' => $item->whenLoaded('profile', function () use ($item) {
                $profile = $item->profile;
                if (is_null($profile->bank)) {
                    return null;
                }

                return $item->profile->bank->name;
            }),
        ];
    }
}
