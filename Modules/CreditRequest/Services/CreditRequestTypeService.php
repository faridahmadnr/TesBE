<?php

namespace Modules\CreditRequest\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\CreditRequest\Entities\CreditRequestType;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

final class CreditRequestTypeService extends BaseService
{
    public function __construct(CreditRequestType $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->model::select([
            "id",
            "name",
            "min_value",
            "max_value",
            "interest",
            "created_at",
        ]);
        $results = QueryBuilder::for($query)
            ->defaultSort("-created_at")
            ->allowedFields(["name", "min_value", "max_value"])
            ->allowedFilters(["name", AllowedFilter::trashed()])
            ->allowedSorts([
                "name",
                AllowedSort::field("min_value", "min"),
                AllowedSort::field("max_value", "max"),
                AllowedSort::field("created_at", "createdAt"),
            ])
            ->paginate(request()->query("pageSize") ?? 10)
            ->appends(request()->query());

        return $results;
    }

    public function store(array $data = []): CreditRequestType
    {
        DB::beginTransaction();

        try {
            $testimoni = $this->createCreditRequestType($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(
                __(
                    "There was a problem registering this testimoni. Please try again."
                )
            );
        }

        // event(new CreditRequestTypeCreated($testimoni));
        DB::commit();

        return $testimoni;
    }

    public function update(
        CreditRequestType $testimoni,
        array $data = []
    ): CreditRequestType {
        DB::beginTransaction();

        try {
            if (
                $testimoni->name === "Kur Kecil" ||
                $testimoni->name === "Kur Super Mikro" ||
                $testimoni->name === "Kur Mikro"
            ) {
                $data["name"] = $testimoni->name;
            }
            $testimoni->fill($data);
            $testimoni->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(
                __(
                    "There was a problem updating this testimoni. Please try again."
                )
            );
        }

        // event(new CreditRequestTypeUpdated($testimoni));
        DB::commit();

        return $testimoni;
    }

    public function delete(CreditRequestType $testimoni): CreditRequestType
    {
        if ($this->deleteById($testimoni->id)) {
            // event(new CreditRequestTypeDeleted($testimoni));

            return $testimoni;
        }

        throw new GeneralException(
            "There was a problem deleting this testimoni. Please try again."
        );
    }

    public function restore(CreditRequestType $testimoni): CreditRequestType
    {
        if ($testimoni->restore()) {
            // event(new CreditRequestTypeRestored($testimoni));

            return $testimoni;
        }

        throw new GeneralException(
            __(
                "There was a problem restoring this testimoni. Please try again."
            )
        );
    }

    public function destroy(CreditRequestType $testimoni): bool
    {
        if ($testimoni->forceDelete()) {
            // event(new CreditRequestTypeDestroyed($testimoni));

            return true;
        }

        throw new GeneralException(
            __(
                "There was a problem permanently deleting this testimoni. Please try again."
            )
        );
    }

    protected function createCreditRequestType(
        array $data = []
    ): CreditRequestType {
        return $this->model::create([
            "name" => $data["name"] ?? null,
            "min_value" => $data["min"] ?? 0,
            "max_value" => $data["max"] ?? 0,
            "interest" => $data["interest"] ?? 0,
        ]);
    }
}
