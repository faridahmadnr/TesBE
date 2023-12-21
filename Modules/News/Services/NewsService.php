<?php

namespace Modules\News\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\News\Entities\News;
use Modules\News\Entities\NewsCategory;
use Spatie\QueryBuilder\AllowedSort;

final class NewsService extends BaseService
{
    public function __construct(News $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query = $this->select([
            'id',
            'title',
            'slug',
            'featured_image',
            'summary',
            'status',
            'created_at',
        ])
            ->allowedSorts([
                'title',
                AllowedSort::field('createdAt', 'created_at'),
            ])
            ->toQueryBuilder();

        return $query;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createNews($data);

            $categories = collect($data['categories'] ?? []);

            $categories = $categories->map(function ($category) {
                return NewsCategory::keyFromHashId($category);
            });

            if ($categories->isEmpty()) {
                $categoryId = NewsCategory::whereName('Uncategorized')->first()->id;
                $categories->push($categoryId); // Uncategorized always number 1
            }
            $user->categories()->sync($categories->toArray());
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this news. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    public function update(News $news, array $data = []): News
    {
        DB::beginTransaction();

        try {
            if (isset($data['featured_image'])) {
                $image = $data['featured_image'];
                $filename = $this->generateFilename($image);
                $data['featured_image'] = $filename;

                $image->storeAs('news', $filename);
            }

            $categories = collect($data['categories'] ?? []);

            $categories = $categories->map(function ($category) {
                return NewsCategory::keyFromHashId($category);
            });

            if ($categories->isEmpty()) {
                $categoryId = NewsCategory::whereName('Uncategorized')->first()->id;
                $categories->push($categoryId); // Uncategorized always number 1
            }
            $news->categories()->sync($categories->toArray());

            $news->fill($data);

            $news->save();

        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this news. Please try again.'));
        }

        DB::commit();

        return $news;
    }

    public function delete(News $news): News
    {
        if ($this->deleteById($news->id)) {

            return $news;
        }

        throw new GeneralException('There was a problem deleting this news. Please try again.');
    }

    public function restore(News $news): News
    {
        if ($news->restore()) {

            return $news;
        }

        throw new GeneralException(__('There was a problem restoring this news. Please try again.'));
    }

    public function destroy(News $news): bool
    {
        if ($news->forceDelete()) {

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this news. Please try again.'));
    }

    protected function generateFilename(UploadedFile $image): string
    {
        $filename = sha1(now()).'.'.$image->getClientOriginalExtension();

        return $filename;
    }

    protected function createNews(array $data = []): News
    {
        $slug = Str::slug($data['title']);

        /** @var UploadedFile $image */
        $image = $data['featured_image'];
        $filename = $this->generateFilename($image);

        $news = $this->model::create([
            'title' => $data['title'],
            'slug' => $slug,
            'content' => $data['content'],
            'summary' => Str::limit($data['content'], 200),
            'featured_image' => $filename,
            'status' => isset($data['status']) ? $data['status'] : 1,
        ]);

        $image->storeAs('news', $filename);

        return $news;
    }
}
