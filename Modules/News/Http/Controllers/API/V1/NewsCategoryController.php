<?php

namespace Modules\News\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\News\Entities\NewsCategory;
use Modules\News\Http\Requests\StoreNewsCategoryRequest;
use Modules\News\Http\Requests\UpdateNewsCategoryRequest;
use Modules\News\Services\NewsCategoryService;
use Modules\News\Transformers\NewsCategoryCollection;
use Modules\News\Transformers\NewsCategoryResource;

class NewsCategoryController extends BaseController
{
    public function __construct(
        private NewsCategoryService $newsCategoryService
    ) {
        $this->authorizeResource(NewsCategory::class, 'category');
    }

    public function index(): JsonResponse
    {
        $news = $this->newsCategoryService->getAll();

        return $this->successResponse(new NewsCategoryCollection($news));
    }

    public function store(StoreNewsCategoryRequest $request): JsonResponse
    {
        $newsCategory = $this->newsCategoryService->store($request->validated());

        return $this->okResponse(new NewsCategoryResource($newsCategory));
    }

    public function show(NewsCategory $category): JsonResponse
    {
        return $this->okResponse(new NewsCategoryResource($category));
    }

    public function update(UpdateNewsCategoryRequest $request, NewsCategory $category): JsonResponse
    {
        $category = $this->newsCategoryService->update($category, $request->validated());

        return $this->okResponse(new NewsCategoryResource($category));
    }

    public function destroy(NewsCategory $category): JsonResponse
    {
        $this->newsCategoryService->delete($category);

        return $this->okResponse(new NewsCategoryResource($category));
    }

    public function restore(NewsCategory $category): JsonResponse
    {
        $this->newsCategoryService->restore($category);

        return $this->okResponse(new NewsCategoryResource($category));
    }

    public function forceDelete(NewsCategory $category): JsonResponse
    {
        $this->newsCategoryService->destroy($category);

        return $this->okResponse(new NewsCategoryResource($category));
    }
}
