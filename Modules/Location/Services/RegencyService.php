<?php

namespace Modules\Location\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Location\Entities\Province;
use Modules\Location\Entities\Regency;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class RegencyService extends BaseService
{
    public function __construct(Regency $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            'id',
            'name',
            'province_id',
            'created_at',
        ])->with(['province', 'districts']);

        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name'])
            ->allowedFilters([
                'name',
                AllowedFilter::callback('province', function (Builder $query, $province) {
                    $query->whereHas('province', function (Builder $query) use ($province) {
                        $provinceId = Province::keyFromHashId($province);
                        $query->where('id', $provinceId);
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
            $regency = $this->createRegency($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this regency. Please try again.'));
        }

        // event(new RegencyCreated($regency));

        DB::commit();

        return $regency;
    }

    public function update(Regency $regency, array $data = []): Regency
    {
        DB::beginTransaction();

        try {
            $regency->fill($data);
            $regency->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this regency. Please try again.'));
        }

        // event(new RegencyUpdated($regency));
        DB::commit();

        return $regency;
    }

    public function delete(Regency $regency): Regency
    {
        if ($this->deleteById($regency->id)) {
            // event(new RegencyDeleted($regency));

            return $regency;
        }

        throw new GeneralException('There was a problem deleting this regency. Please try again.');
    }

    public function restore(Regency $regency): Regency
    {
        if ($regency->restore()) {
            // event(new RegencyRestored($regency));

            return $regency;
        }

        throw new GeneralException(__('There was a problem restoring this regency. Please try again.'));
    }

    public function destroy(Regency $regency): bool
    {
        if ($regency->trashed()
            && $regency->forceDelete()) {

            // event(new RegencyDestroyed($regency));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this regency. Please try again.'));
    }

    protected function createRegency(array $data = []): Regency
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'province_id' => $data['province_id'] ?? null,
        ]);
    }
}
