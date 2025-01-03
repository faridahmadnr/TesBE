<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Location\Entities\Regency;
use Modules\Location\Enums\RegencyEnum;
use Modules\Report\Enums\QuartersEnum;
use Nette\NotImplementedException;
use Spatie\QueryBuilder\QueryBuilder;

final class SubmissionStatusService extends BaseService
{
    public function getSubmissionStatus($type)
    {
        $year = request()->filter['year'] ?? null;
        $quarter = request()->filter['quarter'] ?? null;

        if ($type == 'region') {
            return $this->getSubmissionStatusByRegency(year: $year, quarter: $quarter);
        }

        if ($type == 'kurType') {
            return $this->getSubmissionStatusByKurType(year: $year, quarter: $quarter);
        }

        if ($type == 'stats') {
            return $this->getSubmissionStatusByStats(year: $year, quarter: $quarter);
        }

        if ($type == 'gender') {
            return $this->getSubmissionStatusByGender(year: $year, quarter: $quarter);
        }

        throw new NotImplementedException('Not implemented yet');
    }

    private function getSubmissionStatusByRegency($year = null, $quarter = null)
    {
        $creditRequestTypes = $this->getCreditRequestTypes();

        $query = Regency::whereIn('name', RegencyEnum::validRegencies())
            ->withSubmissionStatus(
                creditRequestTypes: $creditRequestTypes,
                year: $year,
                quarter: $quarter
            );
        $data = QueryBuilder::for($query)
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $data;
    }

    private function getSubmissionStatusByKurType($year = null, $quarter = null)
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

    private function getCreditRequestTypes()
    {
        return CreditRequestType::pluck('name', 'id')
            ->mapWithKeys(function ($creditRequestTypeName, $creditRequestTypeId) {
                return [$creditRequestTypeName => $creditRequestTypeId];
            });
    }

    private function getSubmissionStatusByStats($year = null, $quarter = null)
    {
        $query = CreditRequest::when($year, function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        })
            ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
            });

        foreach (CreditRequestStatusEnum::cases() as $status) {
            $query->selectRaw(
                'SUM(COALESCE(CASE WHEN status = '
                .$status->value
                .' THEN 1 ELSE 0 END, 0)) AS '
                .$status->name
            );
        }

        $data = array_change_key_case($query->first()->toArray());
        unset($data['user']);
        unset($data['histories']);

        return $data;
    }

    private function getSubmissionStatusByGender($year = null, $quarter = null)
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
}
