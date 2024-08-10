<?php

namespace Modules\Report\Services;

use App\Services\BaseService;
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
        $query = CreditRequestType::withSubmissionStatus(
            year: $year,
            quarter: $quarter
        );

        $query = QueryBuilder::for($query)
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

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

        $statuses = array_map(fn ($column) => strtolower($column->name), CreditRequestStatusEnum::cases());

        return $query->first()->only($statuses);
    }
}
