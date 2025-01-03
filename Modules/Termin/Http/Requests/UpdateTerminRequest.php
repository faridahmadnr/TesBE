<?php

namespace Modules\Termin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;

class UpdateTerminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_CREDIT_TERM->value);
    }
}
