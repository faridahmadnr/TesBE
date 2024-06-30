<?php

namespace Modules\DataVisualization\Services;

use App\Services\BaseService;
use Modules\DataVisualization\Enums\QuartersEnum;
use Illuminate\Pagination\LengthAwarePaginator;

use Modules\Bank\Entities\Bank;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;


final class BankDistributionDataService extends BaseService
{

    public function getAll()
    {

        $year = (request()->input('year'));
        $quarter = request()->input('quarter');
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue($quarter);

        $allRealizationMark =$this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:null);

        $bankTypeResult = Bank::all()->map(function ($bank) use ($startMonth, $endMonth, $year, $quarter, $allRealizationMark) {
            $totalPotentialDebtor   = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:null, bankId:$bank->id);
            $totalDebtor            = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:$bank->id);
            $totalTransaction       = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value,creditRequestTypeId:null, regencyId:null, bankId:$bank->id);
            $realizationMark        = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:$bank->id, businessTypeId:null);

            $realizationRate        = ($allRealizationMark!= 0) ? (($realizationMark / $allRealizationMark) * 100) : 0;

            return [
                'name' => $bank->name,
                'logo' => $bank->logo,
                'potentialDebtor' => $totalPotentialDebtor,
                'debtor' => $totalDebtor,
                'transaction' => $totalTransaction,
                'realizationMark' => $realizationMark,
                'realizationRate' => $realizationRate,
            ];
        })->values();;

        $sort = request()->query('sort');

        $sortOptions = [
            'potentialDebtor' => 'potentialDebtor',
            '-potentialDebtor' => 'potentialDebtor',

            'debtor' => 'debtor',
            '-debtor' => 'debtor',

            'transaction' => 'transaction',
            '-transaction' => 'transaction',

            'realization' => 'realizationMark',
            '-realization' => 'realizationMark',

            'realizationRate' => 'realizationRate',
            '-realizationRate' => 'realizationRate',
        ];

        $sortBy = $sortOptions[$sort] ?? null;

        if ($sortBy !== null) {
            $bankTypeResult = ($sort[0] === '-') ? $bankTypeResult->sortByDesc($sortBy) : $bankTypeResult->sortBy($sortBy);
        }

        $pageSize = request()->query('pageSize') ?? 5;

        $paginatedBankTypeResult = new LengthAwarePaginator(
            array_slice($bankTypeResult->values()->all(), (LengthAwarePaginator::resolveCurrentPage() - 1) * $pageSize, $pageSize),
            count($bankTypeResult),
            $pageSize,
            LengthAwarePaginator::resolveCurrentPage(),
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return $paginatedBankTypeResult;
    }

}
