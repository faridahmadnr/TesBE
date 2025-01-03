<?php

namespace Modules\Report\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;
use Modules\Location\Enums\RegencyEnum;
use Illuminate\Validation\Rule;

class UpdateRegencyReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validRegencies = RegencyEnum::validRegencies();

        return [
            'month' => 'required|string|between:1,12',
            'year' => 'required|string',
            'regency' => ['required', Rule::in($validRegencies)],
            'debtor' => 'required|numeric',
            'contract_value' => 'required|numeric',
            'outstanding_value' => 'required|numeric',
            'target' => 'required|numeric',
            'realization' => 'required|numeric'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can(PermissionsEnum::CREATE_REPORT->value);
    }
}
