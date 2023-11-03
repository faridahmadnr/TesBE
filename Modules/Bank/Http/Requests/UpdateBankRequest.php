<?php

namespace Modules\Bank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;

class UpdateBankRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'code' => 'required|max:50',
            'link' => 'sometimes|url',
            'status' => 'required|boolean',
            'reason_status' => 'nullable|max:255',
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::UPDATE_BANK->value);
    }
}
