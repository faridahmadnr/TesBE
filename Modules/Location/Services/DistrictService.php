<?php

namespace Modules\Location\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Log;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class DistrictService extends BaseService
{
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'name',
            'created_at',
        ])
            ->whereIn('regency_id', [3401, 3402, 3403, 3404, 3405])
            ->with(['regency']);
        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name'])
            ->allowedFilters([
                'name',
                AllowedFilter::callback('regency', function (Builder $query, $regency) {
                    $query->whereHas('regency', function (Builder $query) use ($regency) {
                        $regencyId = Regency::keyFromHashId($regency);
                        Log::info('REGENCY ID', [
                            'regencyId' => $regencyId,
                        ]);
                        $query->where('id', $regencyId);
                    });
                }),
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $district = $this->createDistrict($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this district. Please try again.'));
        }

        // event(new DistrictCreated($district));

        DB::commit();

        return $district;
    }

    public function update(District $district, array $data = []): District
    {
        DB::beginTransaction();

        try {
            $district->fill($data);
            $district->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this district. Please try again.'));
        }

        // event(new DistrictUpdated($district));
        DB::commit();

        return $district;
    }

    public function delete(District $district): District
    {
        if ($this->deleteById($district->id)) {
            // event(new DistrictDeleted($district));

            return $district;
        }

        throw new GeneralException('There was a problem deleting this district. Please try again.');
    }

    public function restore(District $district): District
    {
        if ($district->restore()) {
            // event(new DistrictRestored($district));

            return $district;
        }

        throw new GeneralException(__('There was a problem restoring this district. Please try again.'));
    }

    public function destroy(District $district): bool
    {
        if ($district->forceDelete()) {

            // event(new DistrictDestroyed($district));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this district. Please try again.'));
    }

    protected function createDistrict(array $data = []): District
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'province_id' => $data['province_id'] ?? null,
        ]);
    }
}
