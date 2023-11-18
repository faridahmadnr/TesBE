<?php

namespace Modules\User\Http\Requests;

use Closure;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Modules\User\Entities\User;
use Modules\User\Enums\UserGenderEnum;
use Modules\User\Rules\Captcha;

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
            'identity_number' => 'required|numeric|valid_identity_number|unique:members,identity_number',
            'first_phone' => ['required', 'phone:INTERNATIONAL,ID'],
            'second_phone' => [
                'nullable',
                'phone:INTERNATIONAL,ID',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($this->first_phone === $value) {
                        $fail('The second phone number must be different from the first phone number.');
                    }
                },
            ],
            'address' => 'required',
            'gender' => ['required', Rule::in(UserGenderEnum::cases())],
            'dob' => 'required|date_format:Y-m-d',
            'password' => [
                'required',
                Rules\Password::defaults(),
                PasswordRules::register($this->email),
            ],
            'agreement' => 'required',
            'password_confirmed' => 'required|same:password',
            // 'g-recaptcha-response' => ['required', new Captcha],
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape',
            'identity_number' => 'digit',
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
