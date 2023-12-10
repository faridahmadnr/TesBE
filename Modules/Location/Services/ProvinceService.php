<?php

namespace Modules\Location\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Province;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class ProvinceService extends BaseService
{
    public function __construct(Province $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'name',
            'created_at',
        ]);

        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name'])
            ->allowedFilters([
                'name',
                AllowedFilter::callback('q', function (Builder $query, $term) {
                    $provinceIds = Province::search($term)->keys();
                    $query->whereIn('id', $provinceIds);
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
            $province = $this->createProvince($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this province. Please try again.'));
        }

        // event(new ProvinceCreated($province));

        DB::commit();

        return $province;
    }

    public function update(Province $province, array $data = []): Province
    {
        DB::beginTransaction();

        try {
            $province->fill($data);
            $province->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this province. Please try again.'));
        }

        // event(new ProvinceUpdated($province));
        DB::commit();

        return $province;
    }

    public function delete(Province $province): Province
    {
        if ($this->deleteById($province->id)) {
            // event(new ProvinceDeleted($province));

            return $province;
        }

        throw new GeneralException('There was a problem deleting this province. Please try again.');
    }

    public function restore(Province $province): Province
    {
        if ($province->restore()) {
            // event(new ProvinceRestored($province));

            return $province;
        }

        throw new GeneralException(__('There was a problem restoring this province. Please try again.'));
    }

    public function destroy(Province $province): bool
    {
        if ($province->forceDelete()) {

            // event(new ProvinceDestroyed($province));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this province. Please try again.'));
    }

    protected function createProvince(array $data = []): Province
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }
}
