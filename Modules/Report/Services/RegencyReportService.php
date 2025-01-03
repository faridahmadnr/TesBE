<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\Location\Enums\RegencyEnum;
use Modules\Report\Entities\RegencyReport;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class RegencyReportService extends BaseService
{
    public function __construct(RegencyReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'regency_id',
            'credit_request_type_id',
            'date',
            'debtor',
            'target',
            'realization',
            'created_at',
            'updated_at',
        ])
            ->with('creditRequestType')
            ->when(request()->input('regency'), function ($query) {
                if ($regencyEnum = RegencyEnum::filterParameter(request()->input('regency'))) {
                    $query->where('regency_id', $regencyEnum);
                }
            });

        $regencyReports = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'debtor',
                'target',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $regencyReports;
    }

    public function show(RegencyReport $regencyReport)
    {
        return $regencyReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createRegencyReport($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this regency report. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(RegencyReport $regencyReport, array $data = []): RegencyReport
    {

        DB::beginTransaction();

        try {
            $data['date'] = new DateTime($data['year'].'-'.$data['month'].'-01');
            $data['regency_id'] = RegencyEnum::fromValue($data['regency']);

            $regencyReport->fill($data);
            $regencyReport->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this sector report. Please try again.'));
        }

        DB::commit();

        return $regencyReport;
    }

    public function delete(RegencyReport $regencyReport): RegencyReport
    {
        if ($this->deleteById($regencyReport->id)) {

            return $regencyReport;
        }

        throw new GeneralException('There was a problem deleting this termin. Please try again.');
    }

    public function restore(RegencyReport $regencyReport): RegencyReport
    {
        if ($regencyReport->restore()) {

            return $regencyReport;
        }

        throw new GeneralException(__('There was a problem restoring this termin. Please try again.'));
    }

    public function destroy(RegencyReport $regencyReport): bool
    {
        if ($regencyReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this termin. Please try again.'));
    }

    protected function createRegencyReport(array $data = []): RegencyReport
    {

        return $this->model::create([
            'regency_id' => RegencyEnum::fromValue($data['regency']),
            'date' => new DateTime($data['year'].'-'.$data['month'].'-01'),
            'debtor' => $data['debtor'] ?? null,
            'contract_value' => $data['contract_value'] ?? null,
            'outstanding_value' => $data['outstanding_value'] ?? null,
            'target' => $data['target'] ?? null,
            'realization' => $data['realization'] ?? null,
        ]);
    }
}
