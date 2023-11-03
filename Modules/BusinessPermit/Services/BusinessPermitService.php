<?php

namespace Modules\BusinessPermit\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class BusinessPermitService extends BaseService
{
    public function __construct(BusinessPermit $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select(['id', 'name', 'created_at']);
        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['name'])
            ->allowedFilters(['name', AllowedFilter::trashed()])
            ->allowedSorts([
                'name',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createBusinessPermit($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this business permit. Please try again.'));
        }

        // event(new BusinessPermitCreated($businessPermit));
        DB::commit();

        return $user;
    }

    public function update(BusinessPermit $businessPermit, array $data = []): BusinessPermit
    {
        DB::beginTransaction();

        try {
            $businessPermit->fill($data);

            $businessPermit->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this business permit. Please try again.'));
        }

        // event(new BusinessPermitUpdated($businessPermit));
        DB::commit();

        return $businessPermit;
    }

    public function delete(BusinessPermit $businessPermit): BusinessPermit
    {
        if ($this->deleteById($businessPermit->id)) {
            // event(new BusinessPermitDeleted($businessPermit));

            return $businessPermit;
        }

        throw new GeneralException('There was a problem deleting this business permit. Please try again.');
    }

    public function restore(BusinessPermit $businessPermit): BusinessPermit
    {
        if ($businessPermit->restore()) {
            // event(new BusinessPermitRestored($businessPermit));

            return $businessPermit;
        }

        throw new GeneralException(__('There was a problem restoring this business permit. Please try again.'));
    }

    public function destroy(BusinessPermit $businessPermit): bool
    {
        if (! $businessPermit->trashed()) {
            throw new GeneralException(__('This business permit can not be deleted because it is not in a deleted state.'));
        }

        if ($businessPermit->forceDelete()) {
            // event(new BusinessPermitDestroyed($businessPermit));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this business permit. Please try again.'));
    }

    protected function createBusinessPermit(array $data = []): BusinessPermit
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }
}
