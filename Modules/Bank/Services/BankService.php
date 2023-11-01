<?php

namespace Modules\Bank\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\Bank\Entities\Bank;
use Spatie\QueryBuilder\QueryBuilder;

final class BankService extends BaseService
{
    public function __construct(Bank $user)
    {
        $this->model = $user;
    }

    public function getAllBank()
    {
        $bankQuery = $this->model::select(['id', 'name', 'email']);
        $banks = QueryBuilder::for($bankQuery)
            ->allowedFields(['id', 'email'])
            ->allowedFilters(['name', 'email'])
            ->paginate(10)
            ->appends(request()->query());

        return $banks;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this bank. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    protected function createUser(array $data = []): Bank
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
        ]);
    }
}
