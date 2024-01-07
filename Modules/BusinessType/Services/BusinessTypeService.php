<?php

namespace Modules\BusinessType\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\BusinessType\Entities\BusinessType;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;

class BusinessTypeService extends BaseService
{
    public function __construct(BusinessType $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $businessTypes = $this->select(['id', 'name', 'created_at'])
            ->allowedFilters(['name', AllowedFilter::trashed()])
            ->allowedSorts([
                'name',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->toQueryBuilder();

        return $businessTypes;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createBusinessType($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this business type. Please try again.'));
        }

        // event(new BusinessTypeCreated($businessType));
        DB::commit();

        return $user;
    }

    public function update(BusinessType $businessType, array $data = []): BusinessType
    {
        DB::beginTransaction();

        try {
            $businessType->fill($data);

            $businessType->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this business type. Please try again.'));
        }

        // event(new BusinessTypeUpdated($businessType));
        DB::commit();

        return $businessType;
    }

    public function delete(BusinessType $businessType): BusinessType
    {
        if ($this->deleteById($businessType->id)) {
            // event(new BusinessTypeDeleted($businessType));

            return $businessType;
        }

        throw new GeneralException('There was a problem deleting this business type. Please try again.');
    }

    public function restore(BusinessType $businessType): BusinessType
    {
        if ($businessType->restore()) {
            // event(new BusinessTypeRestored($businessType));

            return $businessType;
        }

        throw new GeneralException(__('There was a problem restoring this business type. Please try again.'));
    }

    public function destroy(BusinessType $businessType): bool
    {
        if ($businessType->forceDelete()) {
            // event(new BusinessTypeDestroyed($businessType));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this business type. Please try again.'));
    }

    protected function createBusinessType(array $data = []): BusinessType
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }
}
