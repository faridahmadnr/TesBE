<?php

namespace Modules\DataVisualization\Services;

use App\Services\BaseService;
use Modules\DataVisualization\Enums\QuartersEnum;

use Modules\Report\Entities\RegencyReport;
use Modules\Location\Enums\RegencyEnum;
use Illuminate\Support\Facades\Storage;


use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Report\Entities\SectorReport;

final class RegencyDistributionService extends BaseService
{

    public function getAll()
    {
        $year = (request()->input('year'));
        $quarter = request()->input('quarter');
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue($quarter);

        $regencyReport = collect(RegencyEnum::cases())->map(function ($regencyId) use ($startMonth, $endMonth, $year, $quarter) {
            $sums = RegencyReport::when($year, function ($query) use ($year) {
                    $query->whereYear('date', $year);
                })
                ->when($quarter, function ($query) use ($startMonth, $endMonth) {
                    $query->whereMonth('date', '>=', $startMonth)
                          ->whereMonth('date', '<=', $endMonth);
                })
                ->where('regency_id', $regencyId)
                ->select('debtor', 'realization', 'target')
                ->get();

            $total_debtor = $sums->sum('debtor');
            $total_realization = $sums->sum('realization');
            $total_target = $sums->sum('target');
            $realizationPercentage = $total_target != 0 ? ($total_realization / $total_target) * 100 : 0;

            $debtorValue     = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null);
            $submissionMark  = $this->credReqCalculateSubmissionMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null, businessTypeId:null);
            $realizationMark = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null, businessTypeId:null);

            return [
                'regency' => $regencyId->label(),

                'realizationMark' => $realizationMark,
                'submissionMark' => $submissionMark,
                'debtorValue' => $debtorValue,

                'realizationPercentage' => $realizationPercentage,
                'debtor' => $total_debtor,
                'realization' => $total_realization,
                'target' => $total_target,
            ];
        });

        // DISTRIBUTION
        $submissionMark = $this->credReqCalculateSubmissionMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:null);

        $debtor = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:null);
        $debtor = $debtor + RegencyReport::when($year, function ($query) use ($year, $quarter, $startMonth, $endMonth) {
            $query->whereYear('date', $year);
            if ($quarter) {
                $query->whereMonth('date', '>=', $startMonth)
                      ->whereMonth('date', '<=', $endMonth);
            }
        })
        ->sum('debtor');

        $realizationMark = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:null);
        $realizationMark = $realizationMark + RegencyReport::when($year, function ($query) use ($year) {
            $query->whereYear('date', $year);
        })
        ->when($quarter, function ($query) use ($startMonth, $endMonth) {
            $query->whereMonth('date', '>=', $startMonth)
                  ->whereMonth('date', '<=', $endMonth);
        })
        ->sum('realization');

        $distribution = [
            'debtor' => $debtor,
            'realizationMark' => $realizationMark,
            'submissionMark' =>  $submissionMark,
        ];

        // SUBMISSION BY REGENCY
        $allSubmissionCount = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:null, bankId:null);
        $submissionByRegency = collect(RegencyEnum::cases())->map(function ($regencyId) use ($allSubmissionCount, $startMonth, $endMonth, $year, $quarter) {
            $regencySubmissionCount = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null);
            $submissionPercentage = $allSubmissionCount != 0 ? ($regencySubmissionCount / $allSubmissionCount) * 100 : 0;
            return [
                'regency' => $regencyId->label(),
                'submissionCount' => $regencySubmissionCount,
                'submissionPercentage' => $submissionPercentage
            ];
        });

        // GEOJSON
        // fillOpacity diatur berdasarkan jumlah pengajuan
        // Opacity semakin tinggi ketika jumlah pengajuan semakin tinggi
        $sortedRegencyByRealization = $regencyReport->map(function ($item) {
            $regencyName = $item['regency'];
            $mapIndex = RegencyEnum::getIndexMapGeojson($regencyName);

            return array_merge($item, ['mapIndex' => $mapIndex]);
        })->sortBy('realization')->values()->all();

        $lowestRealization = 0;
        $opacity = ['0.2', '0.4', '0.6', '0.8', '0.9'];
        $opacityIndex = 0;
        foreach ($sortedRegencyByRealization as &$item) {
            if($lowestRealization < $item['realization']){
                $opacityIndex++;
            }
            $item['fillOpacity'] = $opacity[$opacityIndex];
            $lowestRealization = $item['realization'];
        }

        $path = 'data/map.geojson';
        if (!Storage::exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        $geojson = json_decode(Storage::get($path), true);

        // Memasukkan opacity ke json geo
        foreach ($sortedRegencyByRealization as &$item) {
            $geojson['features'][$item['mapIndex']]['properties']['fillOpacity'] = $item['fillOpacity'];
        }

        return [
            'regencyReport' => $regencyReport,
            'submissionByRegency' => $submissionByRegency ,
            'distribution' =>$distribution,
            'map' => $geojson,
        ];
    }
}
