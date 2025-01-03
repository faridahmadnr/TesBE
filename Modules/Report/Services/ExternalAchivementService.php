<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\Report\Entities\AchivementRealizationReport;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class ExternalAchivementService extends BaseService
{
    public function __construct(AchivementRealizationReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'date',
            'target',
            'realization',
            'created_at',
        ]);

        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id'])
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'date',
                'target',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function show(AchivementRealizationReport $achivementRealizationReport)
    {
        return $achivementRealizationReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createData($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this report. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(AchivementRealizationReport $achivementRealizationReport, array $data = []): AchivementRealizationReport
    {

        DB::beginTransaction();

        try {
            $achivementRealizationReport->fill($data);
            $achivementRealizationReport->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating report. Please try again.'));
        }

        DB::commit();

        return $achivementRealizationReport;
    }

    public function delete(AchivementRealizationReport $achivementRealizationReport): AchivementRealizationReport
    {
        if ($this->deleteById($achivementRealizationReport->id)) {

            return $achivementRealizationReport;
        }

        throw new GeneralException('There was a problem deleting. Please try again.');
    }

    public function restore(AchivementRealizationReport $achivementRealizationReport): AchivementRealizationReport
    {
        if ($achivementRealizationReport->restore()) {

            return $achivementRealizationReport;
        }

        throw new GeneralException(__('There was a problem restoring report. Please try again.'));
    }

    public function destroy(AchivementRealizationReport $achivementRealizationReport): bool
    {
        if ($achivementRealizationReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting report. Please try again.'));
    }

    /**
     * Create a new AchivementRealizationReport model instance.
     */
    protected function createData(array $data = []): AchivementRealizationReport
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');

        return $this->model::create([
            'date' => $date,
            'target' => $data['target'] ?? 0,
            'realization' => $data['realization'] ?? 0,
        ]);
    }
}
