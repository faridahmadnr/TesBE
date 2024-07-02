<?php

namespace Modules\Report\Http\Requests;

use App\Rules\HashIdExists;
use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\PermissionsEnum;
use Modules\BusinessType\Entities\BusinessType;

class StoreSectorReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month' => 'required|string|between:1,12',
            'year' => 'required|string',
            'business_type_id' => [
                'sometimes',
                new HashIdExists(BusinessType::class)
            ],
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
