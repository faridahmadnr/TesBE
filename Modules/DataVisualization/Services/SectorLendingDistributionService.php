<?php

namespace Modules\DataVisualization\Services;


use App\Services\BaseService;
use Modules\BusinessType\Entities\BusinessType;

use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\DataVisualization\Enums\QuartersEnum;

use Modules\Report\Entities\SectorReport;


final class SectorLendingDistributionService extends BaseService
{
    public function getAll()
    {
        $year = (request()->input('year'));
        $quarter = request()->input('quarter');
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue($quarter);

        $result = collect(BusinessType::pluck('name','id'))->map(function ($businessTypeName, $businessTypeId) use ($startMonth, $endMonth, $year, $quarter) {
            
            $sumsSectorReport = SectorReport::when($year, function ($query) use ($year) {
                    $query->whereYear('date', $year);
                })
                ->when($quarter, function ($query) use ($startMonth, $endMonth) {
                    $query->whereMonth('date', '>=', $startMonth)
                          ->whereMonth('date', '<=', $endMonth);
                })
                ->where('business_type_id', $businessTypeId)
                ->select('debtor', 'realization', 'target')
                ->get();

            $total_debtor = $sumsSectorReport->sum('debtor');
            $total_realization = $sumsSectorReport->sum('realization');
            $total_target = $sumsSectorReport->sum('target');
            $realizationPercentage = $total_target != 0 ? ($total_realization / $total_target) * 100 : 0;

            $submissionMark = $this->credReqCalculateSubmissionMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:$businessTypeId);
            $realizationMark = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:$businessTypeId);

            return [
                'businessType' => $businessTypeName,

                'realizationMark' => $realizationMark,
                'submissionMark' => $submissionMark,

                'realizationPercentage' => $realizationPercentage,
                'debtor' => $total_debtor,
                'realization' => $total_realization,
                'target' => $total_target,
            ];
        })->values();

        return [
            'sectorLending' => $result,
        ];

    }
}
