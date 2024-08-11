<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\Bank\Entities\Bank;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Report\Enums\QuartersEnum;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class BankDistributionService extends BaseService
{
    public function getAll()
    {
        $banks = QueryBuilder::for($this->getBaseQuery())
            ->defaultSort('name')
            ->allowedSorts([
                AllowedSort::field('name', 'name'),
                AllowedSort::field('potentialDebtor', 'potential'),
                AllowedSort::field('debtor', 'debtor'),
                AllowedSort::field('transaction', 'transaction'),
                AllowedSort::field('realization', 'realizationMark'),
                AllowedSort::field('realizationRate', 'realizationRate'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $banks;
    }

    public function getChart()
    {
        $query = $this->getBaseQuery()
            ->when(request()->input('sort'), function ($query) {
                $query->orderBy('realization', \Str::contains(request()->input('sort'), '-') ? 'desc' : 'asc');
            });

        return $query->get()->map(fn ($bank) => [
            'name' => $bank->name,
            'realization' => $bank->realization,
        ]);
    }

    private function getBaseQuery()
    {
        $year = request()->filter['year'] ?? null;
        $quarter = request()->filter['quarter'] ?? null;

        $realizationQuery = 'SUM(CASE WHEN credit_requests.status = '
            .CreditRequestStatusEnum::APPROVED->value
            .' AND '
            .DB::regexp('credit_requests.remark', '^[0-9]+$')
            .' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END)';
        $allRealizationQuery = 'SUM(CASE WHEN '
            .DB::regexp('credit_requests.remark', '^[0-9]+$')
            .' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END)';
        $creditRequestQuery = Bank::query()
            ->select([
                'banks.name as name',
                'banks.logo as logo',
                DB::raw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN 1 ELSE 0 END, 0)) AS potential'), // potential debitor
                DB::raw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS debtor'), // debitor
                DB::raw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS transaction'),
                DB::raw("$realizationQuery AS realization"),
                DB::raw("
                    CASE WHEN $allRealizationQuery > 0 THEN
                        $realizationQuery / $allRealizationQuery * 100
                    ELSE
                        0
                    END AS rate
                "),
            ])
            ->leftJoin('credit_requests', function ($join) use ($year, $quarter) {
                $join->on('banks.id', '=', 'credit_requests.bank_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('credit_requests.created_at', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                    });
            })
            ->distinct()
            ->groupBy('banks.name', 'banks.logo');

        return $creditRequestQuery;
    }
}
