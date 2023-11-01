<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Modules\User\Entities\User;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'trim', 'escape'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'indisposable',
                'max:255',
                'unique:'.User::class,
            ],
            'nik' => 'required|digit|valid_nik',
            'phone' => 'phone:INTERNATIONAL,ID',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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
