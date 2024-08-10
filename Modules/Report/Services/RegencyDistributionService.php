<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
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
        $year = (request()->input('year')) ?? date('Y');
        $quarter = request()->input('quarter');

        $regencyReport = $this->getReportByRegency(year: $year, quarter: $quarter);
        $distribution = $this->getDistribution(year: $year, quarter: $quarter);
        $submissions = $this->getSubmissionByRegency(year: $year, quarter: $quarter);

        $path = 'data/map.geojson';
        if (! Storage::exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        $geojson = json_decode(Storage::get($path), true);

        foreach ($geojson as $key => $geo) {
            $data = $submissions->where('id', str_replace('-', '', $geo['id']))->first();
            $geojson[$key]['properties']['percentage'] = $data['percentage'] ?? 0;
            $geojson[$key]['properties']['submission'] = $data['submission'] ?? 0;
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
        $totalDebitor = CreditRequest::where('status', CreditRequestStatusEnum::APPROVED->value)
            ->when($year, function ($query) use ($year) {
                $query->whereYear('created_at', $year);
            })
            ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                $query->whereRaw('EXTRACT(QUARTER FROM created_at) = ?', [$quarter]);
            })
            ->selectRaw('count(id) as debitor')
            ->selectRaw('coalesce(sum(amount), 0) as amount')
            ->selectRaw('SUM(CASE WHEN remark ~ \'^[0-9]+$\' THEN CAST(remark AS decimal) ELSE 0 END) as realization');

        return $totalDebitor->first();
    }

    private function getSubmissionByRegency($quarter, $year)
    {
        $allSubmission = CreditRequest::where('status', 4)
            ->when($year, function ($query) use ($year) {
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
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN 1 ELSE 0 END, 0)) AS submission')
            ->groupBy('regencies.name', 'regencies.id')
            ->get()
            ->map(function ($item) use ($allSubmission) {

                return [
                    'id' => $item->id,
                    'name' => ucwords($item->name),
                    // @phpstan-ignore-next-line
                    'submission' => $item->submission,
                    // @phpstan-ignore-next-line
                    'percentage' => $allSubmission > 0 ? round($item->submission / $allSubmission * 100, 2) : 0,
                ];
            });

        return $regencies;
    }

    private function getReportByRegency($quarter, $year = null)
    {
        $regencies = Regency::whereIn('name', RegencyEnum::validRegencies())
            ->leftJoin('regency_reports', function ($join) use ($year, $quarter) {
                $join->on('regencies.id', '=', 'regency_reports.regency_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('regency_reports.date', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM regency_reports.date) = ?', [$quarter]);
                    });
            })
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
            ->selectRaw('SUM(COALESCE(regency_reports.debtor, 0)) as total_debitor')
            ->selectRaw('SUM(COALESCE(regency_reports.realization, 0)) as total_realization')
            ->selectRaw('SUM(COALESCE(regency_reports.target, 0)) as total_target')
            ->selectRaw('LOWER(regencies.name) as name')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS debtor_value')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN amount ELSE 0 END, 0)) AS submission_amount')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::APPROVED->value.' AND credit_requests.remark ~ \'^[0-9]+$\' THEN 1 ELSE 0 END, 0)) AS realization_amount')
            ->groupBy('regencies.name')
            ->get()
            ->sortBy('total_realization')
            ->map(function ($item, $index) {
                return [
                    'name' => ucwords($item->name),
                    'submissionAmount' => $item->submission_amount,
                    'submissionAmountText' => formatCurrency($item->submission_amount),
                    'realizationAmount' => $item->realization_amount,
                    'realizationAmountText' => formatCurrency($item->realization_amount),
                    'debtorValue' => $item->debtor_value,
                    'realizationPercentage' => $item->total_target > 0 ? ($item->total_realization / $item->total_target) * 100 : 0,
                    'realization' => $item->total_realization,
                    'debitor' => $item->total_debitor,
                    'target' => $item->total_target,
                    'opacity' => ($index + 1) * 0.195,
                ];
            });

        return $regencies->values();
    }
}
