<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\Report\Entities\QuinquennialReport;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class ExternalQuinquennialService extends BaseService
{
    public function __construct(QuinquennialReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'date',
            'debitor',
            'realization',
            'created_at',
        ]);

        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name'])
            ->allowedFilters([
                'debitor',
                'realization',
            ])
            ->allowedSorts([
                'date',
                'debitor',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function show(QuinquennialReport $quinquennialReport)
    {
        return $quinquennialReport;
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

    public function update(QuinquennialReport $quinquennialReport, array $data = []): QuinquennialReport
    {

        DB::beginTransaction();

        try {
            $quinquennialReport->fill($data);
            $quinquennialReport->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating report. Please try again.'));
        }

        DB::commit();

        return $quinquennialReport;
    }

    public function delete(QuinquennialReport $quinquennialReport): QuinquennialReport
    {
        if ($this->deleteById($quinquennialReport->id)) {

            return $quinquennialReport;
        }

        throw new GeneralException('There was a problem deleting. Please try again.');
    }

    public function restore(QuinquennialReport $quinquennialReport): QuinquennialReport
    {
        if ($quinquennialReport->restore()) {

            return $quinquennialReport;
        }

        throw new GeneralException(__('There was a problem restoring report. Please try again.'));
    }

    public function destroy(QuinquennialReport $quinquennialReport): bool
    {
        if ($quinquennialReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting report. Please try again.'));
    }

    /**
     * Create a new QuinquennialReport model instance.
     */
    protected function createData(array $data = []): QuinquennialReport
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');

        return $this->model::create([
            'date' => $date,
            'debitor' => $data['debitor'] ?? 0,
            'realization' => $data['realization'] ?? 0,
        ]);
    }
}
