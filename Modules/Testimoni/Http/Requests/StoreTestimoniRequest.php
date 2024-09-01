<?php

namespace Modules\Testimoni\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;

class StoreTestimoniRequest extends FormRequest
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
            'name' => 'required',
            'email' => [
                'nullable',
                'string',
                'lowercase',
                'email',
                'indisposable',
                'max:255',
            ],
            'message' => 'required|string',
            'is_anonymous' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|escape',
            'email' => 'trim|escape',
            'message' => 'escape',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_TESTIMONI->value);
    }
}
