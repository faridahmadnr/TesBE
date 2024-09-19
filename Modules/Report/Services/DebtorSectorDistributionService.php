<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Report\Enums\QuartersEnum;
use Spatie\QueryBuilder\QueryBuilder;

final class DebtorSectorDistributionService extends BaseService
{
    public function getAll()
    {
        $year = request()->filter['year'] ?? now('Y');
        $quarter = request()->filter['quarter'] ?? null;

        $query = BusinessType::leftJoin('sector_reports', function ($join) use ($year, $quarter) {
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
            ->selectRaw('SUM(COALESCE(sector_reports.contract_value, 0)) as contract')
            ->selectRaw('SUM(COALESCE(sector_reports.target, 0)) as target')
            ->groupBy('business_types.name');

        $debitors = QueryBuilder::for($query)
            ->defaultSort('name')
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $debitors;
    }
}
