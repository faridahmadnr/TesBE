<?php

namespace Modules\Requirement\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Modules\Requirement\Entities\Requirement;
use Storage;

final class RequirementService extends BaseService
{
    public function __construct(Requirement $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->select()
            ->allowedSorts(['name'])
            ->allowedFields(['id', 'name', 'summary', 'image', 'description'])
            ->toQueryBuilder();

        return $query;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createRequirement($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this requirement. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(Requirement $requirement, array $data = []): Requirement
    {
        DB::beginTransaction();

        try {
            $requirement->fill($data);

            if (isset($data['image'])) {
                $this->deleteImage($requirement);
                $requirement->image = $this->uploadImage($data['image']);
            }

            $requirement->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this requirement. Please try again.'));
        }

        DB::commit();

        return $requirement;
    }

    public function delete(Requirement $requirement): Requirement
    {
        if ($this->deleteById($requirement->id)) {

            return $requirement;
        }

        throw new GeneralException('There was a problem deleting this requirement. Please try again.');
    }

    public function restore(Requirement $requirement): Requirement
    {
        if ($requirement->restore()) {

            return $requirement;
        }

        throw new GeneralException(__('There was a problem restoring this requirement. Please try again.'));
    }

    public function destroy(Requirement $requirement): bool
    {
        if ($requirement->forceDelete()) {
            $this->deleteImage($requirement);

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this requirement. Please try again.'));
    }

    protected function createRequirement(array $data = []): Requirement
    {
        $imagePath = '';

        if (isset($data['image'])) {
            /** @var \Illuminate\Http\UploadedFile $image */
            $image = $data['image'];
            $imagePath = $this->uploadImage($image);
        }

        return $this->model::create([
            'name' => $data['name'] ?? null,
            'description' => $data['description'] ?? null,
            'summary' => $data['summary'] ?? null,
            'status' => $data['status'] ?? null,
            'image' => $imagePath,
        ]);
    }

    private function uploadImage($image): string
    {
        $filename = sha1(now()).'.'.$image->getClientOriginalExtension();
        $image->storeAs($this->model->imagePath, $filename);

        return $filename;
    }

    private function deleteImage(Requirement $requirement): void
    {
        if ($requirement->image) {
            Storage::delete($this->model->imagePath.$requirement->image);
        }
    }
}
