<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Regency;
use Modules\Report\Entities\RegencyReport;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class ExternalRegencyService extends BaseService
{
    public function __construct(RegencyReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'date',
            'regency_id',
            'debtor',
            'outstanding_value',
            'realization',
            'percentage',
            'created_at',
        ])
            ->with(['regency']);

        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id'])
            ->allowedFilters([
                'name',
                AllowedFilter::callback('regency', function (Builder $query, $regency) {
                    $query->whereHas('regency', function (Builder $query) use ($regency) {
                        $regencyId = Regency::keyFromHashId($regency);
                        $query->where('id', $regencyId);
                    });
                }),
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                'date',
                'debtor',
                'regency_id',
                'outstanding_value',
                'realization',
                'percentage',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function show(RegencyReport $regencyReport)
    {
        return $regencyReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createRegionReport($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this report. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(RegencyReport $regencyReport, array $data = []): RegencyReport
    {

        DB::beginTransaction();

        try {
            $this->updateRegionReport($regencyReport, $data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating report. Please try again.'));
        }

        DB::commit();

        return $regencyReport;
    }

    public function delete(RegencyReport $regencyReport): RegencyReport
    {
        if ($this->deleteById($regencyReport->id)) {

            return $regencyReport;
        }

        throw new GeneralException('There was a problem deleting. Please try again.');
    }

    public function restore(RegencyReport $regencyReport): RegencyReport
    {
        if ($regencyReport->restore()) {

            return $regencyReport;
        }

        throw new GeneralException(__('There was a problem restoring report. Please try again.'));
    }

    public function destroy(RegencyReport $regencyReport): bool
    {
        if ($regencyReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting report. Please try again.'));
    }

    /**
     * Create a new RegencyReport model instance.
     */
    protected function createRegionReport(array $data = []): RegencyReport
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');

        return $this->model::create([
            'regency_id' => Regency::keyFromHashId($data['regency_id']),
            'date' => $date,
            'debtor' => $data['debtor'] ?? 0,
            'outstanding_value' => $data['outstanding'] ?? 0,
            'realization' => $data['realization'] ?? 0,
            'percentage' => $data['percentage'] ?? 0,
        ]);
    }

    protected function updateRegionReport(RegencyReport $regencyReport, array $data = [])
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');

        $regencyReport->fill([
            'regency_id' => Regency::keyFromHashId($data['regency_id']),
            'date' => $date,
            'debtor' => $data['debtor'] ?? 0,
            'outstanding_value' => $data['outstanding'] ?? 0,
            'realization' => $data['realization'] ?? 0,
            'percentage' => $data['percentage'] ?? 0,
        ]);
        $regencyReport->save();
    }
}
