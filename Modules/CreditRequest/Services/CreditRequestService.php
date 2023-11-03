<?php

namespace Modules\CreditRequest\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\CreditRequest\Entities\CreditRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class CreditRequestService extends BaseService
{
    public function __construct(CreditRequest $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select(['id', 'name', 'min_value', 'max_value', 'created_at']);
        $results = QueryBuilder::for($query)
            ->defaultSort('-created_at')
            ->allowedFields(['name', 'min_value', 'max_value'])
            ->allowedFilters([
                'name',
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                AllowedSort::field('min_value', 'min'),
                AllowedSort::field('max_value', 'max'),
                AllowedSort::field('created_at', 'createdAt'),
            ])
            ->paginate(10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = []): CreditRequest
    {
        DB::beginTransaction();

        try {
            $creditRequest = $this->createCreditRequest($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this credit request. Please try again.'));
        }

        // event(new CreditRequestCreated($creditRequest));
        DB::commit();

        return $creditRequest;
    }

    public function update(CreditRequest $creditRequest, array $data = []): CreditRequest
    {
        DB::beginTransaction();

        try {
            $creditRequest->fill($data);
            $creditRequest->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this credit request. Please try again.'));
        }

        // event(new CreditRequestUpdated($creditRequest));
        DB::commit();

        return $creditRequest;
    }

    public function delete(CreditRequest $creditRequest): CreditRequest
    {
        if ($this->deleteById($creditRequest->id)) {
            // event(new CreditRequestDeleted($creditRequest));

            return $creditRequest;
        }

        throw new GeneralException('There was a problem deleting this credit request. Please try again.');
    }

    public function restore(CreditRequest $creditRequest): CreditRequest
    {
        if ($creditRequest->restore()) {
            // event(new CreditRequestRestored($creditRequest));

            return $creditRequest;
        }

        throw new GeneralException(__('There was a problem restoring this credit request. Please try again.'));
    }

    public function destroy(CreditRequest $creditRequest): bool
    {
        if (! $creditRequest->trashed()) {
            throw new GeneralException(__('This creditRequest can not be deleted because it is not in a deleted state.'));
        }

        if ($creditRequest->forceDelete()) {
            // event(new CreditRequestDestroyed($creditRequest));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this credit request. Please try again.'));
    }

    protected function createCreditRequest(array $data = []): CreditRequest
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'min_value' => $data['min_value'] ?? 0,
            'max_value' => $data['max_value'] ?? 0,
        ]);
    }
}
