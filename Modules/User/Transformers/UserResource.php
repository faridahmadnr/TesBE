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
            'name' => $this->name,
            'isActive' => (bool) $this->status,
            'createdAt' => $this->created_at,
            'lastLoginAt' => $this->last_login_at,
            'role' => $this->whenLoaded('roles', function () {
                $role = $this->roles ? $this->roles->first() : null;

                if (is_null($role)) {
                    return null;
                }

                return [
                    'id' => $role->hashId,
                    'name' => $role->description,
                ];
            }),
            'phone' => $this->whenLoaded('profile', function () {
                return $this->profile->phone;
            }),
            'avatar' => $this->whenLoaded('profile', function () {
                return $this->profile->photo;
            }),
            'bank' => $this->whenLoaded('profile', function () {
                $profile = $this->profile;
                if (is_null($profile->bank)) {
                    return null;
                }

                return [
                    'id' => $profile->bank->hashId,
                    'name' => $profile->bank->name,
                ];
            }),
            'isVerified' => $this->email_verified_at !== null,
        ];
    }
}
