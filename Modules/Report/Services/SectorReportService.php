<?php

namespace Modules\Report\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Log;

use DateTime;


use Modules\Report\Entities\SectorReport;
use Modules\BusinessType\Entities\BusinessType;

final class SectorReportService extends BaseService
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
            'debtor',
            'contract_value',
            'outstanding_value',
            'target',
            'realization',
            'created_at',
            'updated_at'
        ]);

        if ($hashedBusinessTypeId = request()->input('businessTypeId')) {
            if ($businessTypeId = BusinessType::keyFromHashId($hashedBusinessTypeId)) {
                $query->where('business_type_id', $businessTypeId);
            } else {
                throw new GeneralException(__('There was a problem getting the sector reports. Please try again.'));
            }
        }

        $sectorReports = QueryBuilder::for($query)
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


        $sectorReports->getCollection()->transform(function ($item) {
            $item['year'] = date('Y', strtotime($item->date));
            $item['month'] = date('n', strtotime($item->date));
            return $item;
        });

        return $sectorReports;
    }

    public function show(SectorReport $sectorReport){
        $sectorReport->year = date('Y', strtotime($sectorReport->date));
        $sectorReport->month = date('n', strtotime($sectorReport->date));

        return $sectorReport;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createSectorReport($data);
            $user->year = $user['date']->format('Y');
            $user->month = $user['date']->format('n');

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
            $data['date'] = new DateTime($data['year'] . '-' . $data['month'] . '-01');
            $data['business_type_id'] = BusinessType::keyFromHashId($data['business_type_id']);

            $sectorReport->fill($data);
            $sectorReport->save();

            $sectorReport->year = $sectorReport['date']->format('Y');
            $sectorReport->month = $sectorReport['date']->format('n');

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

            $sectorReport->year = date('Y', strtotime($sectorReport->date));
            $sectorReport->month =date('n', strtotime($sectorReport->date));

            return $sectorReport;
        }

        throw new GeneralException('There was a problem deleting this termin. Please try again.');
    }

    public function restore(SectorReport $sectorReport): SectorReport
    {
        if ($sectorReport->restore()) {

            $sectorReport->year = date('Y', strtotime($sectorReport->date));
            $sectorReport->month =date('n', strtotime($sectorReport->date));

            return $sectorReport;
        }

        throw new GeneralException(__('There was a problem restoring this termin. Please try again.'));
    }

    public function destroy(SectorReport $sectorReport): bool
    {
        if ($sectorReport->forceDelete()) {

            $sectorReport->year = date('Y', strtotime($sectorReport->date));
            $sectorReport->month =date('n', strtotime($sectorReport->date));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this termin. Please try again.'));
    }


    protected function createSectorReport(array $data = []): SectorReport
    {
        return $this->model::create([
            'business_type_id' => BusinessType::keyFromHashId($data['business_type_id']),
            'date' => new DateTime($data['year'] . '-' . $data['month'] . '-01'),
            'debtor' => $data['debtor'] ?? null,
            'contract_value' => $data['contract_value'] ?? null,
            'outstanding_value' => $data['outstanding_value'] ?? null,
            'target' => $data['target'] ?? null,
            'realization' => $data['realization'] ?? null,
        ]);
    }

}
