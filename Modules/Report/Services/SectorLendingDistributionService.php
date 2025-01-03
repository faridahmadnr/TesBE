<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\BusinessType\Entities\BusinessType;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Report\Enums\QuartersEnum;
use Spatie\QueryBuilder\QueryBuilder;

final class SectorLendingDistributionService extends BaseService
{
    public function getAll()
    {
        $year = request()->filter['year'] ?? null;
        $quarter = request()->filter['quarter'] ?? null;

        $query = BusinessType::leftJoin('credit_requests', function ($join) use ($year, $quarter) {
            $join->on('business_types.id', '=', 'credit_requests.business_type_id')
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('credit_requests.created_at', $year);
                })
                ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                    [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                    $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                });
        })
            ->leftJoin('sector_reports', function ($join) use ($year, $quarter) {
                $join->on('business_types.id', '=', 'sector_reports.business_type_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('sector_reports.date', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM sector_reports.date) = ?', [$quarter]);
                    });
            })
            ->select('business_types.name as name')
            ->selectRaw('SUM(COALESCE(sector_reports.debtor, 0)) as debtor')
            ->selectRaw('SUM(COALESCE(sector_reports.realization, 0)) as realization')
            ->selectRaw('SUM(COALESCE(sector_reports.target, 0)) as target')
            ->selectRaw('SUM(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN credit_requests.amount ELSE 0 END) AS submission_amount')
            ->selectRaw('SUM(CASE WHEN credit_requests.status = '
                .CreditRequestStatusEnum::APPROVED->value
                .' AND '
                .DB::regexp('credit_requests.remark', '^[0-9]+$')
                .' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END) AS realization_amount')
            ->groupBy(
                'business_types.name',
            );

        $sectorLendings = QueryBuilder::for($query)
            ->defaultSort('name')
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $sectorLendings;
    }
}
