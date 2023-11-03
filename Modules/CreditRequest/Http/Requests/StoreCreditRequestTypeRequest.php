<?php

namespace Modules\CreditRequest\Http\Requests;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;

class StoreCreditRequestTypeRequest extends FormRequest
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
            'min' => 'required|numeric|min:0',
            'max' => 'required|numeric|gt:min',
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
        return true;
    }
}
