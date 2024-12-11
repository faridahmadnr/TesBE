<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Report\Entities\SectorReport;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class ExternalSectorReportService extends BaseService
{
    public function __construct(SectorReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'business_type_id',
            'date',
            'realization',
            'debitor',
            'created_at',
            'updated_at',
        ])->with('businessType');

        $data = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'date',
                'realization',
                'debitor',
                AllowedSort::field('created_at', 'createdAt'),
                AllowedSort::field('business_type_id', 'businessType'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $data;
    }

    public function show(SectorReport $sectorReport)
    {
        return $sectorReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createSectorReport($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this report. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(SectorReport $sectorReport, array $data = []): SectorReport
    {

        DB::beginTransaction();

        try {
            $this->updateSectorReport($sectorReport, $data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating report. Please try again.'));
        }

        DB::commit();

        return $sectorReport;
    }

    public function delete(SectorReport $sectorReport): SectorReport
    {
        if ($this->deleteById($sectorReport->id)) {

            return $sectorReport;
        }

        throw new GeneralException('There was a problem deleting. Please try again.');
    }

    public function restore(SectorReport $sectorReport): SectorReport
    {
        if ($sectorReport->restore()) {

            return $sectorReport;
        }

        throw new GeneralException(__('There was a problem restoring report. Please try again.'));
    }

    public function destroy(SectorReport $sectorReport): bool
    {
        if ($sectorReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting report. Please try again.'));
    }

    protected function createSectorReport(array $data = []): SectorReport
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');
        if ($data['quarter'] == 'Q2') {
            $date = $data['year'].'-04-01';
        }

        if ($data['quarter'] == 'Q3') {
            $date = $data['year'].'-07-01';
        }

        if ($data['quarter'] == 'Q4') {
            $date = $data['year'].'-10-01';
        }

        return $this->model::create([
            'business_type_id' => BusinessType::keyFromHashId($data['business_type_id']),
            'date' => $date,
            'realization' => $data['realization'] ?? 0,
            'debitor' => $data['debitor'] ?? 0,
        ]);
    }

    protected function updateSectorReport(SectorReport $sectorReport, array $data = [])
    {
        $month = '01';
        $date = new DateTime($data['year'].'-'.$month.'-01');
        if ($data['quarter'] == 'Q2') {
            $date = $data['year'].'-04-01';
        }

        if ($data['quarter'] == 'Q3') {
            $date = $data['year'].'-07-01';
        }

        if ($data['quarter'] == 'Q4') {
            $date = $data['year'].'-10-01';
        }

        $sectorReport->fill([
            'business_type_id' => BusinessType::keyFromHashId($data['business_type_id']),
            'date' => $date,
            'realization' => $data['realization'] ?? 0,
            'debitor' => $data['debitor'] ?? 0,
        ]);
        $sectorReport->save();
    }
}
