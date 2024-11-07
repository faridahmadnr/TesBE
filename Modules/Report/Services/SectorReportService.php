<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Report\Entities\SectorReport;
use Modules\Report\Enums\QuartersEnum;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class SectorReportService extends BaseService
{
    public function __construct(SectorReport $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        if (request()->query('type') === 'graph') {
            return $this->getGraphData();
        }

        $query = $this->model::select([
            'id',
            'business_type_id',
            'date',
            'target',
            'realization',
            'created_at',
            'updated_at',
        ])->with('businessType');

        $sectorReports = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFilters([
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'date',
                'realization',
                AllowedSort::field('created_at', 'createdAt'),
                AllowedSort::field('submission', 'target'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $sectorReports;
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
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this sector report. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(SectorReport $sectorReport, array $data = []): SectorReport
    {

        DB::beginTransaction();

        try {
            $data['date'] = new DateTime($data['year'].'-'.$data['month'].'-01');
            $data['business_type_id'] = BusinessType::keyFromHashId($data['business_type_id']);

            $sectorReport->fill($data);
            $sectorReport->save();

        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this sector report. Please try again.'));
        }

        DB::commit();

        return $sectorReport;
    }

    public function delete(SectorReport $sectorReport): SectorReport
    {
        if ($this->deleteById($sectorReport->id)) {

            return $sectorReport;
        }

        throw new GeneralException('There was a problem deleting this termin. Please try again.');
    }

    public function restore(SectorReport $sectorReport): SectorReport
    {
        if ($sectorReport->restore()) {

            return $sectorReport;
        }

        throw new GeneralException(__('There was a problem restoring this termin. Please try again.'));
    }

    public function destroy(SectorReport $sectorReport): bool
    {
        if ($sectorReport->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this termin. Please try again.'));
    }

    protected function createSectorReport(array $data = []): SectorReport
    {
        return $this->model::create([
            'business_type_id' => BusinessType::keyFromHashId($data['business_type_id']),
            'date' => $data['year'].'-'.$data['month'].'-01',
            'debtor' => $data['debtor'] ?? null,
            'contract_value' => $data['contract_value'] ?? null,
            'outstanding_value' => $data['outstanding_value'] ?? null,
            'target' => $data['target'] ?? null,
            'realization' => $data['realization'] ?? null,
        ]);
    }

    private function getGraphData()
    {
        $year = request()->query('year');
        $quarter = request()->query('quarter');

        $query = BusinessType::leftJoin('sector_reports', function ($join) use ($year, $quarter) {
            $join->on('business_types.id', '=', 'sector_reports.business_type_id')
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('sector_reports.date', $year);
                })
                ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                    [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                    $query->whereRaw('EXTRACT(QUARTER FROM sector_reports.date) = ?', [$quarter]);
                })
                ->where('sector_reports.deleted_at', null);
        })
            ->selectRaw('business_types.name as name')
            ->selectRaw('SUM(COALESCE(sector_reports.realization, 0)) as realization')
            ->selectRaw('SUM(COALESCE(sector_reports.target, 0)) as submission')
            ->orderBy('business_types.id')
            ->groupBy('business_types.id');

        return $query->get()->map(function ($item) {
            return [
                'name' => $item->name,
                'realization' => $item->realization,
                'submission' => $item->submission,
                'realizationText' => formatCurrency($item->realization),
                'submissionText' => formatCurrency($item->submission),
            ];
        });
    }
}
