<?php

namespace Modules\Requirement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;

class UpdateRequirementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'summary' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::UPDATE_CREDIT_REQUEST_REQUIREMENT->value);
    }
}
