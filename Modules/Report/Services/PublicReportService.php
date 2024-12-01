<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\BusinessType\Entities\BusinessType;
use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Location\Entities\Regency;
use Modules\Location\Enums\RegencyEnum;
use Modules\Report\Entities\AchivementRealizationReport;
use Modules\Report\Entities\SectorReport;
use Modules\Report\Enums\QuartersEnum;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class PublicReportService extends BaseService
{
    public function __construct(SectorReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        if (request()->query('type') === 'graph') {
            return $this->getGraphData();
        }

        $query = $this->model::select([
            'id',
            'business_type_id',
            'date',
            'target',
            'realization',
            'created_at',
            'updated_at',
        ])->with('businessType');

        $sectorReports = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'date',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
                AllowedSort::field('submission', 'target'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $sectorReports;
    }

    private function getGraphData()
    {
        $year = request()->query('year');
        $quarter = request()->query('quarter');

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
            ->selectRaw('business_types.name as name')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' THEN credit_requests.amount ELSE 0 END, 0)) AS submission')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' AND '.DB::regexp('credit_requests.remark', '^[0-9]+$').' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS realization')
            ->orderBy('business_types.id')
            ->groupBy('business_types.id');

        return $query->get()->map(function ($item) {
            return [
                'name' => $item->name,
                // @phpstan-ignore-next-line
                'realization' => $item->realization,
                // @phpstan-ignore-next-line
                'submission' => $item->submission,
                // @phpstan-ignore-next-line
                'realizationText' => formatCurrency($item->realization),
                // @phpstan-ignore-next-line
                'submissionText' => formatCurrency($item->submission),
            ];
        });
    }

    public function getReportAppBySubmission($quarter, $year = null)
    {
        $query = CreditRequestType::leftJoin('credit_requests', function ($join) use ($year, $quarter) {
            $join->on('credit_request_types.id', '=', 'credit_requests.credit_request_type_id')
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('credit_requests.created_at', $year);
                })
                ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                    [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                    $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                });
        })
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS debitor')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' AND '.DB::regexp('credit_requests.remark', '^[0-9]+$').' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS submission')
            ->selectRaw('credit_request_types.name as name')
            ->groupBy('credit_request_types.name')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->name,
                    // @phpstan-ignore-next-line
                    'debitor' => $item->debitor,
                    // @phpstan-ignore-next-line
                    'submission' => intval($item->submission),
                    // @phpstan-ignore-next-line
                    'submissionText' => formatCurrency($item->submission),
                ];
            });

        return $query;
    }

    public function getReportAppByGender($quarter, $year = null)
    {
        $query = CreditRequest::when($year, function ($query) use ($year) {
            $query->whereYear('credit_requests.created_at', $year);
        })
            ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
            })
            ->join('users', 'credit_requests.user_id', '=', 'users.id')
            ->join('members', 'users.id', '=', 'members.user_id')
            ->selectRaw('SUM(COALESCE(CASE WHEN members.gender = \'male\' THEN 1 ELSE 0 END, 0)) AS male')
            ->selectRaw('SUM(COALESCE(CASE WHEN members.gender = \'female\' THEN 1 ELSE 0 END, 0)) AS female')
            ->first();

        return $query;
    }

    public function getReportByRegency($quarter, $year = null)
    {
        $query = Regency::whereIn('name', RegencyEnum::validRegencies())
            ->leftJoin('credit_requests', function ($join) use ($year, $quarter) {
                $join->on('regencies.id', '=', 'credit_requests.business_regency_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('credit_requests.created_at', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                    });
            })
            ->selectRaw('LOWER(regencies.name) as name')
            ->selectRaw('regencies.id as id')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS submission')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS realization')
            ->groupBy('regencies.name', 'regencies.id')
            ->get();

        return [];
    }

    public function getReportBySector($quarter, $year = null)
    {
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
            ->selectRaw('SUM(COALESCE(sector_reports.realization, 0)) as realization')
            ->selectRaw('SUM(COALESCE(sector_reports.debitor, 0)) as debitor')
            ->selectRaw('MAX(sector_reports.created_at) AS date')
            ->groupBy('business_types.id');

        return $query->get();
    }

    public function getReportBySector5Year($year = null)
    {
        if (is_null($year)) {
            $year = Carbon::now()->year;
        }
        $fiveYearAgo = Carbon::createFromDate($year)->subYears(4)->year;

        $years = collect(range($fiveYearAgo, $year))->map(function ($item) {
            return ['year' => $item];
        });

        $events = SectorReport::selectRaw('SUM(COALESCE(sector_reports.realization, 0)) as realization')
            ->selectRaw('SUM(COALESCE(sector_reports.debitor, 0)) as debitor')
            ->selectRaw('MAX(sector_reports.date) AS date')
            ->selectRaw('MAX(sector_reports.created_at) AS created_at')
            ->groupBy('sector_reports.date')
            ->orderBy('date')
            ->get();

        $years = collect(range($fiveYearAgo, $year))->map(function ($year) {
            return ['year' => $year];
        });

        $results = $years->map(function ($year) use ($events) {
            $matchingEvent = $events->firstWhere('date', $year['year'].'-01-01');

            return [
                'year' => $year['year'],
                'realization' => $matchingEvent ? $matchingEvent->realization : 0,
                // @phpstan-ignore-next-line
                'debitor' => $matchingEvent ? $matchingEvent->debitor : 0,
                'date' => $matchingEvent ? $matchingEvent->created_at : null,
            ];
        });

        return $results;
    }

    public function getReportByAchivement($quarter, $year = null)
    {
        $query = AchivementRealizationReport::when($year, function ($query) use ($year) {
            $query->whereYear('achivement_realization_reports.date', $year);
        })
            ->selectRaw('SUM(COALESCE(achivement_realization_reports.realization, 0)) as realization')
            ->selectRaw('SUM(COALESCE(achivement_realization_reports.target, 0)) as target')
            ->selectRaw('achivement_realization_reports.created_at as date')
            ->groupBy('achivement_realization_reports.date')
            ->groupBy('achivement_realization_reports.created_at')
            ->first();

        return $query;
    }
}
