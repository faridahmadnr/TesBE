<?php

namespace Modules\User\Http\Requests;

use App\Enums\RolesEnum;
use Closure;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Modules\Bank\Entities\Bank;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class UpdateUserRequest extends FormRequest
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
                Rule::unique('users', 'email')->ignore(request('user')->id),
            ],
            'phone' => 'required|phone:INTERNATIONAL,ID',
            'role_id' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $role = Role::findByHashId($value);

                    if (is_null($role)) {
                        $fail('Role is not exists.');
                    }
                },
            ],
            'bank_id' => [
                Rule::requiredIf(function () {
                    $role = Role::findByHashId($this->role_id);

                    return in_array($role->name, [
                        RolesEnum::ADMIN_BANK->value,
                        RolesEnum::SUB_ADMIN_BANK->value,
                    ]);
                }),
                function (string $attribute, mixed $value, Closure $fail) {
                    $bank = Bank::findByHashId($value);

                    if (is_null($bank)) {
                        $fail('Bank is not exists.');
                    }
                },
            ],
            'password' => [
                Rule::requiredIf(request('password') !== null),
                Rule::when(request('password') !== null, [
                    PasswordRules::changePassword($this->email),
                ]),
            ],
            'password_confirmed' => [
                Rule::requiredIf(request('password') !== null),
                Rule::when(request('password') !== null, [
                    PasswordRules::changePassword($this->email),
                    'same:password',
                ]),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
            'email_verified' => ['nullable', 'boolean'],
            'send_confirmation_email' => ['nullable', 'boolean'],
            'photo' => 'nullable|image|max:2048|mimes:jpg,png,jpeg',
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_USER->value);
    }

    public function messages()
    {
        return [
            'phone' => 'Please enter a valid phone number.',
        ];
    }
}
