<?php

namespace Modules\CreditRequest\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;

class CreditRequestPendingRequest extends FormRequest
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
            'message' => 'required|string',
        ];
    }

    public function filters()
    {
        return [
            'message' => 'trim|escape',
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
