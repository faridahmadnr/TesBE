<?php

namespace Modules\DataVisualization\Services;

use App\Services\BaseService;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\DataVisualization\Enums\QuartersEnum;
use Modules\Location\Enums\RegencyEnum;


use Modules\CreditRequest\Entities\CreditRequestType;

final class SubmissionStatusService extends BaseService
{
    public function getAll()
    {
        $year = (request()->input('year'));
        $quarter = request()->input('quarter');
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue($quarter);

        // Section 1: Status Submission
        $submissionStatus = collect(CreditRequestStatusEnum::cases())->map(function ($enumValue) use ($startMonth, $endMonth, $year, $quarter) {
            $statusCount = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:$enumValue->value, creditRequestTypeId:null, regencyId:null, bankId:null);
            return [
                'status' => $enumValue->label(),
                'count' => $statusCount,
            ];
        });

        // Section 2 & 3: Submission Statistics
        $submissionStatistics = CreditRequestType::pluck('name', 'id')->map(function ($creditRequestTypeName, $creditRequestTypeId) use ($startMonth, $endMonth, $year, $quarter) {

            $totalPotentialDebtor             = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth,  creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:$creditRequestTypeId, regencyId:null, bankId:null);
            $peopleStatusEnum                 = [CreditRequestStatusEnum::DRAFT->value, CreditRequestStatusEnum::PENDING, CreditRequestStatusEnum::CONFIRMED, CreditRequestStatusEnum::PROCESSED];
            $peoplePerCreditrequest           = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth,  creditStatus:$peopleStatusEnum,  creditRequestTypeId:$creditRequestTypeId, regencyId:null, bankId:null);
            $totalDebtor                      = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth,  creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:$creditRequestTypeId, regencyId:null, bankId:null);
            $realizationMark                  = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:$creditRequestTypeId, regencyId:null, bankId:null, businessTypeId:null);

            $potentialDebtorPercentagePerType = ($peoplePerCreditrequest!= 0) ? (($totalPotentialDebtor / $peoplePerCreditrequest) * 100) : 0;

            return [
                'creditRequestType' => $creditRequestTypeName,
                'potentialDebtor' => $totalPotentialDebtor,
                'potentialDebtorPercentagePerType' => $potentialDebtorPercentagePerType,

                'debtor' => $totalDebtor,
                'people' => $peoplePerCreditrequest,
                'realizationMark' => $realizationMark,
            ];
        })->values()->all();


        // Section 4 : Detail daerah jenis KUR per wilayah // regionalKurTypeDetails
        // Each Regency
        $finalResult = collect(RegencyEnum::cases())->map(function ($regencyId) use ($startMonth, $endMonth, $year, $quarter) {
            $totalPotentialDebtor = $this->creditRequestCountDistinctQuery($year, $quarter, $startMonth, $endMonth,  CreditRequestStatusEnum::DRAFT->value, null, $regencyId, null);

            $creditRequestType = CreditRequestType::pluck('name', 'id')->mapWithKeys(function ($creditRequestTypeName,  $creditRequestTypeId ) use ($startMonth, $endMonth, $year, $quarter, $regencyId) {
                $totalCreditRequest = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:$creditRequestTypeId, regencyId:$regencyId, bankId:null);
                return [$creditRequestTypeName => $totalCreditRequest];
            });

            $submissionMark = $this->credReqCalculateSubmissionMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null, businessTypeId:null);
            $realizationMark = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:$regencyId, bankId:null, businessTypeId:null);

            return [
                'region' => $regencyId->label(),
                'potentialDebtor' => $totalPotentialDebtor,
                'creditRequestType' => $creditRequestType,
                'submissionMark' => $submissionMark,
                'realizationMark' => $realizationMark
            ];
        });

        $sort = request()->query('sort');
        $sortOptions = [
            'realization' => 'realizationMark',
            '-realization' => 'realizationMark',
            'submission' => 'submissionMark',
            '-submission' => 'submissionMark',
            'potentialDebtor' => 'potentialDebtor',
            '-potentialDebtor' => 'potentialDebtor',
            'kurKecil' => function ($item) {
                return $item['creditRequestType']['Kur Kecil'];
            },
            '-kurKecil' => function ($item) {
                return $item['creditRequestType']['Kur Kecil'];
            },
            'kurMikro' => function ($item) {
                return $item['creditRequestType']['Kur Mikro'];
            },
            '-kurMikro' => function ($item) {
                return $item['creditRequestType']['Kur Mikro'];
            },
            'kurSuperMikro' => function ($item) {
                return $item['creditRequestType']['Kur Super Mikro'];
            },
            '-kurSuperMikro' => function ($item) {
                return $item['creditRequestType']['Kur Super Mikro'];
            },
        ];

        $sortBy = $sortOptions[$sort] ?? null;
        if ($sortBy !== null) {
            $finalResult = ($sort[0] === '-') ? $finalResult->sortByDesc($sortBy) : $finalResult->sortBy($sortBy);
        }

        // DIY
        $totalPotentialDebtor = $this->creditRequestCountDistinctQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT, creditRequestTypeId:null, regencyId:null, bankId:null);

        $creditRequestType = CreditRequestType::pluck('name', 'id')->mapWithKeys(function ($creditRequestTypeName,  $creditRequestTypeId ) use ($startMonth, $endMonth, $year, $quarter) {
            $totalCreditRequest = $this->creditRequestCountQuery(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT, creditRequestTypeId:$creditRequestTypeId, regencyId:null, bankId:null);
            return [$creditRequestTypeName => $totalCreditRequest];
        });

        $totalSubmission = $this->credReqCalculateSubmissionMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::DRAFT->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:null);
        $totalRealization = $this->credReqCalculateRealizationMark(year:$year, quarter:$quarter, startMonth:$startMonth, endMonth:$endMonth, creditStatus:CreditRequestStatusEnum::APPROVED->value, creditRequestTypeId:null, regencyId:null, bankId:null, businessTypeId:null);

        $finalResult = $finalResult->prepend([
            'region' => 'DIY',
            'potentialDebtor' => $totalPotentialDebtor,
            'creditRequestType' => $creditRequestType,
            'submissionMark' => $totalSubmission,
            'realizationMark' => $totalRealization
        ]);

        $data = [
            'statusSubmission' => $submissionStatus,
            'submissionStatistics' => $submissionStatistics,
            'regionalKurTypeDetails' => $finalResult->values(),
        ];
        return $data;
    }

}

