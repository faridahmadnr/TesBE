<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Location\Entities\Regency;
use Modules\Location\Enums\RegencyEnum;
use Modules\Report\Enums\QuartersEnum;

#[\AllowDynamicProperties]
final class RegencyDistributionService extends BaseService
{
    public function getAll()
    {
        $year = request()->input('year') ?? date('Y');
        $quarter = request()->input('quarter') ?? null;

        $regencyReport = $this->getReportByRegency(year: $year, quarter: $quarter);
        $distribution = $this->getDistribution(year: $year, quarter: $quarter);
        $submissions = $this->getSubmissionByRegency(year: $year, quarter: $quarter);

        $path = 'data/map.geojson';
        if (! Storage::disk('local')->exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $geojson = json_decode(Storage::disk('local')->get($path), true);

        foreach ($geojson as $key => $geo) {
            $data = $submissions->where('id', str_replace('-', '', $geo['id']))->first();
            $geojson[$key]['properties']['percentage'] = $data['percentage'] ?? 0;
            $geojson[$key]['properties']['submission'] = $data['submission'] ?? 0;
            $geojson[$key]['properties']['realization'] = $data['realization'] ?? 0;
            $geojson[$key]['properties']['name'] = $data['name'];
        }

        return [
            'regencies' => $regencyReport,
            'distribution' => [
                'debtor' => $distribution['debitor'],
                'realizationMark' => formatCurrency($distribution['realization']),
                'submissionMark' => formatCurrency($distribution['amount']),
            ],
            'map' => $geojson,
        ];
    }

    private function getDistribution($quarter, $year)
    {
        $totalDebitor = CreditRequest::when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        })
            ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                $query->whereRaw('EXTRACT(QUARTER FROM created_at) = ?', [$quarter]);
            })
            ->selectRaw('COUNT(credit_requests.created_by) as debitor')
            ->selectRaw('coalesce(sum(amount), 0) as amount')
            ->selectRaw('SUM(COALESCE(CASE WHEN '.DB::regexp('remark', '^[0-9]+$').' THEN CAST(remark AS decimal) ELSE 0 END, 0)) AS realization');

        return $totalDebitor->first();
    }

    public function getSubmissionByRegency($quarter, $year)
    {
        $allSubmission = CreditRequest::when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        })
            ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                $query->whereRaw('EXTRACT(QUARTER FROM created_at) = ?', [$quarter]);
            })
            ->count('id');

        $regencies = Regency::whereIn('name', RegencyEnum::validRegencies())
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
            ->get()
            ->map(function ($item) use ($allSubmission) {

                return [
                    'id' => $item->id,
                    'name' => ucwords($item->name),
                    // @phpstan-ignore-next-line
                    'submission' => $item->submission,
                    // @phpstan-ignore-next-line
                    'realization' => $item->realization,
                    // @phpstan-ignore-next-line
                    'percentage' => $allSubmission > 0 ? round($item->submission / $allSubmission * 100, 2) : 0,
                ];
            });

        return $regencies;
    }

    private function getReportByRegency($quarter, $year = null)
    {
        $regencies = Regency::whereIn('name', RegencyEnum::validRegencies())
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
            ->selectRaw('COUNT(credit_requests.created_by) as total_debitor')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' THEN credit_requests.amount ELSE 0 END, 0)) AS total_target')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' AND '.DB::regexp('credit_requests.remark', '^[0-9]+$').' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS total_realization')
            ->selectRaw('LOWER(regencies.name) as name')
            ->orderBy('name')
            ->groupBy('regencies.name')
            ->get()
            ->map(function ($item, $index) {
                return [
                    'name' => ucwords($item->name),
                    // @phpstan-ignore-next-line
                    'submissionAmount' => $item->total_target,
                    // @phpstan-ignore-next-line
                    'submissionAmountText' => formatCurrency($item->total_target),
                    // @phpstan-ignore-next-line
                    'realizationAmount' => intval($item->total_realization),
                    // @phpstan-ignore-next-line
                    'realizationAmountText' => formatCurrency($item->total_realization),
                    // @phpstan-ignore-next-line
                    'realizationPercentage' => $item->total_target > 0 ? round(($item->total_realization / $item->total_target) * 100, 2) : 0,
                    // @phpstan-ignore-next-line
                    'debitor' => $item->total_debitor,
                    'target' => $item->total_target,
                    'opacity' => ($index + 1) * 0.195,
                ];
            });

        return $regencies->values();
    }
}
