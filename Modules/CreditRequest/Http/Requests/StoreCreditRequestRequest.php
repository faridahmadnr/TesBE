<?php

namespace Modules\CreditRequest\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class StoreCreditRequestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'user_id' => [
            //     'required',
            //     function (string $attribute, mixed $value, Closure $fail) {
            //         $user = User::findByHashId($value);

            //         if (is_null($user)) {
            //             $fail('User is not exists.');
            //         }
            //     },
            // ],
            'business_type_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $businessType = BusinessType::findByHashId($value);

                    if (is_null($businessType)) {
                        $fail('Business type is not exists.');
                    }
                },
            ],
            'business_permit_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $businessPermit = BusinessPermit::findByHashId($value);

                    if (is_null($businessPermit)) {
                        $fail('Business type is not exists.');
                    }
                },
            ],

            'business_tin' => 'sometimes|string',

            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'business_address' => 'required|string',
            'business_regency_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $businessPermit = Regency::findByHashId($value);

                    if (is_null($businessPermit)) {
                        $fail('Regency is not exists.');
                    }
                },
            ],
            'business_district_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $businessPermit = District::findByHashId($value);

                    if (is_null($businessPermit)) {
                        $fail('District is not exists.');
                    }
                },
            ],
            'village' => 'required|string',
            'postal_code' => 'required|string',

            'credit_request_type_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $creditRequestType = CreditRequestType::findByHashId($value);

                    if (is_null($creditRequestType)) {
                        $fail('Credit request type is not exists.');
                    }
                },
            ],
            'amount' => 'required|numeric',
            'termin_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $termin = Termin::findByHashId($value);

                    if (is_null($termin)) {
                        $fail('Termin is not exists.');
                    }
                },
            ],
            'bank_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $bank = Bank::findByHashId($value);

                    if (is_null($bank)) {
                        $fail('Termin is not exists.');
                    }
                },
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_CREDIT_REQUEST->value);
    }
}
