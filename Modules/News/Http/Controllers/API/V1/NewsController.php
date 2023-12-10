<?php

namespace Modules\News\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\News\Entities\News;
use Modules\News\Http\Requests\StoreNewsRequest;
use Modules\News\Http\Requests\UpdateNewsRequest;
use Modules\News\Services\NewsService;
use Modules\News\Transformers\NewsCollection;
use Modules\News\Transformers\NewsResource;

class NewsController extends BaseController
{
    public function __construct(
        private NewsService $newsService
    ) {
        $this->authorizeResource(News::class, 'news');
    }

    public function index(): JsonResponse
    {
        $news = $this->newsService->getAll();

        return $this->successResponse(new NewsCollection($news));
    }

    public function store(StoreNewsRequest $request): JsonResponse
    {
        $news = $this->newsService->store($request->validated());

        return $this->okResponse(new NewsResource($news));
    }

    public function show(News $news): JsonResponse
    {
        return $this->okResponse(new NewsResource($news));
    }

    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $news = $this->newsService->update($news, $request->validated());

        return $this->okResponse(new NewsResource($news));
    }

    public function destroy(News $news): JsonResponse
    {
        $this->newsService->delete($news);

        return $this->okResponse(new NewsResource($news));
    }

    public function restore(News $news): JsonResponse
    {
        $this->newsService->restore($news);

        return $this->okResponse(new NewsResource($news));
    }

    public function forceDelete(News $news): JsonResponse
    {
        $this->newsService->destroy($news);

        return $this->okResponse(new NewsResource($news));
    }
}
