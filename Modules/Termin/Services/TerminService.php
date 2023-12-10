<?php

namespace Modules\Termin\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\Termin\Entities\Termin;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class TerminService extends BaseService
{
    public function __construct(Termin $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select(['id', 'name', 'value', 'created_at']);
        $termins = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['name'])
            ->allowedFilters(['name', AllowedFilter::trashed()])
            ->allowedSorts([
                'name',
                'value',
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $termins;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createTermin($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this termin. Please try again.'));
        }

        // event(new TerminCreated($termin));
        DB::commit();

        return $user;
    }

    public function update(Termin $termin, array $data = []): Termin
    {
        DB::beginTransaction();

        try {
            $termin->fill($data);

            $termin->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this termin. Please try again.'));
        }

        // event(new TerminUpdated($termin));
        DB::commit();

        return $termin;
    }

    public function delete(Termin $termin): Termin
    {
        if ($this->deleteById($termin->id)) {
            // event(new TerminDeleted($termin));

            return $termin;
        }

        throw new GeneralException('There was a problem deleting this termin. Please try again.');
    }

    public function restore(Termin $termin): Termin
    {
        if ($termin->restore()) {
            // event(new TerminRestored($termin));

            return $termin;
        }

        throw new GeneralException(__('There was a problem restoring this termin. Please try again.'));
    }

    public function destroy(Termin $termin): bool
    {
        if ($termin->forceDelete()) {
            // event(new TerminDestroyed($termin));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this termin. Please try again.'));
    }

    protected function createTermin(array $data = []): Termin
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'value' => $data['value'] ?? null,
        ]);
    }
}
