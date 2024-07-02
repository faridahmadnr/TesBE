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
            'date',
            'debtor',
            'contract_value',
            'outstanding_value',
            'target',
            'realization',
            'created_at',
            'updated_at',
        ]);

        try {
            if ($regency = request()->input('regency')) {
                if ($regencyEnum = RegencyEnum::filterParameter($regency)) {
                    $query->where('regency_id', $regencyEnum);
                }
            }
        } catch (\TypeError $e) {
            throw new GeneralException(__('There was a problem getting the regency reports. Please try again.'));
        }

        $regencyReports = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'date',
                'debtor',
                AllowedSort::field('contractValue', 'contract_value'),
                AllowedSort::field('outstandingValue', 'outstanding_value'),
                'target',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        $regencyReports->getCollection()->transform(function (mixed $item) {
            // @phpstan-ignore-next-line
            $item['year'] = date('Y', strtotime($item->date));
            // @phpstan-ignore-next-line
            $item['month'] = date('n', strtotime($item->date));

            return $item;
        });

        return $regencyReports;
    }

    public function show(RegencyReport $regencyReport)
    {
        // @phpstan-ignore-next-line
        $regencyReport->year = date('Y', strtotime($regencyReport['date']));
        // @phpstan-ignore-next-line
        $regencyReport->month = date('n', strtotime($regencyReport['date']));

        return $regencyReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createRegencyReport($data);
            // @phpstan-ignore-next-line
            $user->year = $user['date']->format('Y');
            // @phpstan-ignore-next-line
            $user->month = $user['date']->format('n');

        } catch (\Throwable $th) {
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

            // @phpstan-ignore-next-line
            $regencyReport->year = $regencyReport['date']->format('Y');
            // @phpstan-ignore-next-line
            $regencyReport->month = $regencyReport['date']->format('n');

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
