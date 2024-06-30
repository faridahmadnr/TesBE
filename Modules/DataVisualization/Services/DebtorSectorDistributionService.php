<?php

namespace Modules\DataVisualization\Services;

use App\Services\BaseService;
use Modules\BusinessType\Entities\BusinessType;
use Modules\DataVisualization\Enums\QuartersEnum;

use Modules\Report\Entities\SectorReport;


final class DebtorSectorDistributionService extends BaseService
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
                ->select('debtor', 'contract_value', 'target')
                ->get();

            $totalDebtor = $sumsSectorReport->sum('debtor');
            $totalContract = $sumsSectorReport->sum('contract_value');
            $totalTarget = $sumsSectorReport->sum('target');

            return [
                'businessType' => $businessTypeName,
                'debtor' => $totalDebtor,
                'contractValue' => $totalContract,
                'target' => $totalTarget,
            ];
        })->values();

        return [
            'debtorSector' => $result,
        ];
    }
}
