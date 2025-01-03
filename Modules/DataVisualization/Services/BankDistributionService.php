<?php

namespace Modules\DataVisualization\Services;

use App\Services\BaseService;
use Modules\DataVisualization\Enums\QuartersEnum;
use Illuminate\Pagination\LengthAwarePaginator;

use Modules\Bank\Entities\Bank;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;


final class BankDistributionService extends BaseService
{
    public function getAll(){

        $year = (request()->input('year'));
        $quarter = request()->input('quarter');
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue($quarter);

        $bankTypeResult = Bank::all()->map(function ($bank) use ($startMonth, $endMonth, $year, $quarter) {
            $realizationMark = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:$bank->id, businessTypeId:null);
            return [
                'name' => $bank->name,
                'realizationMark' => $realizationMark,
            ];
        });

        $sort = request()->query('sort');
        if ($sort === 'realization') {
            $bankTypeResult = $bankTypeResult->sortBy('realizationMark');
        } elseif ($sort === '-realization') {
            $bankTypeResult = $bankTypeResult->sortByDesc('realizationMark');
        }
        return [
            'bankDistribution' => $bankTypeResult->values(),
        ];
    }

}
