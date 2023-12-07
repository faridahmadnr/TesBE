<?php

namespace Modules\User\Http\Requests;

use App\Enums\RolesEnum;
use Closure;
use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Modules\Bank\Entities\Bank;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Enums\PermissionsEnum;

class StoreUserRequest extends FormRequest
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
                'sometimes',
                Rule::requiredIf(function () {
                    $role = Role::findByHashId($this->role_id);

                    return in_array($role->name, [
                        RolesEnum::ADMIN_BANK->value,
                        RolesEnum::SUB_ADMIN_BANK->value,
                    ]);
                }),
                function (string $attribute, mixed $value, Closure $fail) {
                    Log::info('BANK', [
                        'value' => $value,
                    ]);
                    if ($value) {
                        $bank = Bank::findByHashId($value);

                        if (is_null($bank)) {
                            $fail('Bank is not exists.');
                        }
                    }
                },
            ],
            'password' => [
                'required',
                Rules\Password::defaults(),
                PasswordRules::register($this->email),
            ],
            'password_confirmed' => 'required|same:password',
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
            'email_verified' => ['sometimes', 'in:y,n'],
            'send_confirmation_email' => ['sometimes', 'in:y,n'],
            'photo' => 'sometimes|image|max:2048|mimes:jpg,png,jpeg',
            'active' => 'required|in:y,n',
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
