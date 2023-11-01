<?php

namespace Modules\BusinessPermit\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Spatie\QueryBuilder\QueryBuilder;

final class BusinessPermitService extends BaseService
{
    public function __construct(BusinessPermit $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select(['id', 'name', 'email']);
        $results = QueryBuilder::for($query)
            ->allowedFields(['id', 'email'])
            ->allowedFilters(['name', 'email'])
            ->paginate(10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this business permit. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    protected function createUser(array $data = []): BusinessPermit
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }
}
