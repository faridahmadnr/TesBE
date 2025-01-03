<?php

namespace Modules\CreditRequest\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\Termin\Entities\Termin;

class CreditRequestSimulationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'creditRequestType' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $creditRequestType = CreditRequestType::findByHashId($value);

                    if (is_null($creditRequestType)) {
                        $fail('Credit request type is not found');
                    }
                },
            ],
            'loanDuration' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $termin = Termin::findByHashId($value);

                    if (is_null($termin)) {
                        $fail(__('Loan duration not found'));
                    }
                },
            ],
            'amount' => [
                'required',
                'numeric',
                function (string $attribute, mixed $value, Closure $fail) {
                    $termin = CreditRequestType::findByHashId($this->creditRequestType);
                    $terminMinAmount = $termin->min_value;
                    $terminMaxAmount = $termin->max_value;

                    if ($value > $terminMaxAmount) {
                        $fail(
                            __('The loan amount must be less than or equal to :amount', ['amount' => $terminMaxAmount])
                        );
                    }
                    if ($value < $terminMinAmount) {
                        $fail(
                            __('The loan amount must be greater than or equal to :amount', ['amount' => $terminMinAmount])
                        );
                    }
                },
            ],
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
