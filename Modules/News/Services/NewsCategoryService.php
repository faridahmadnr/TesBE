<?php

namespace Modules\News\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\News\Entities\NewsCategory;

final class NewsCategoryService extends BaseService
{
    public function __construct(NewsCategory $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->select(['id', 'name', 'slug', 'deleted_at', 'created_at'])
            ->allowedSorts(['name'])
            ->toQueryBuilder();

        return $query;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createNewsCategory($data);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this news category. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(NewsCategory $newsCategory, array $data = []): NewsCategory
    {
        DB::beginTransaction();

        try {
            $newsCategory->fill($data);

            $newsCategory->save();
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this news category. Please try again.'));
        }

        DB::commit();

        return $newsCategory;
    }

    public function delete(NewsCategory $newsCategory): NewsCategory
    {
        if ($newsCategory->slug === 'uncategorized') {
            throw new GeneralException('The uncategorized category cannot be deleted.');
        }

        if ($this->deleteById($newsCategory->id)) {

            return $newsCategory;
        }

        throw new GeneralException('There was a problem deleting this news category. Please try again.');
    }

    public function restore(NewsCategory $newsCategory): NewsCategory
    {
        if ($newsCategory->restore()) {

            return $newsCategory;
        }

        throw new GeneralException(__('There was a problem restoring this news category. Please try again.'));
    }

    public function destroy(NewsCategory $newsCategory): bool
    {
        if ($newsCategory->slug === 'uncategorized') {
            throw new GeneralException('The uncategorized category cannot be deleted.');
        }

        if ($newsCategory->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this news category. Please try again.'));
    }

    protected function createNewsCategory(array $data = []): NewsCategory
    {
        $slug = Str::slug($data['name']);

        return $this->model::create([
            'name' => $data['name'] ?? null,
            'slug' => $slug,
        ]);
    }
}
