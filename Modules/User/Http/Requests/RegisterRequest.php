<?php

namespace Modules\User\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Modules\User\Entities\User;
use Modules\User\Enums\UserGenderEnum;

class RegisterRequest extends FormRequest
{
    use SanitizesInput;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'indisposable',
                'max:255',
                'unique:'.User::class,
            ],
            'nik' => 'required|numeric|valid_nik|unique:members,nik',
            'phone' => 'phone:INTERNATIONAL,ID',
            'address' => 'required',
            'gender' => ['required', Rule::in(UserGenderEnum::cases())],
            'dob' => 'required|date_format:Y-m-d',
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
                PasswordRules::register($this->email),
            ],
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape',
            'nik' => 'digit',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
