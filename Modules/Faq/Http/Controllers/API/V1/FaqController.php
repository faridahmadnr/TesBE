<?php

namespace Modules\Faq\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Http\Requests\StoreFaqRequest;
use Modules\Faq\Http\Requests\UpdateFaqRequest;
use Modules\Faq\Services\FaqService;
use Modules\Faq\Transformers\FaqCollection;
use Modules\Faq\Transformers\FaqResource;

class FaqController extends BaseController
{
    public function __construct(
        private FaqService $faqService
    ) {
        $this->authorizeResource(Faq::class, 'faq');
    }

    public function index()
    {
        $faqs = $this->faqService->getAll();

        return $this->successResponse(new FaqCollection($faqs));
    }

    public function store(StoreFaqRequest $request): JsonResponse
    {
        $faq = $this->faqService->store($request->validated());

        return $this->okResponse(new FaqResource($faq));
    }

    public function show(Faq $faq): JsonResponse
    {
        $faq->loadMissing(['user', 'user.member']);

        return $this->okResponse(new FaqResource($faq));
    }

    public function update(UpdateFaqRequest $request, Faq $faq): JsonResponse
    {
        $faq = $this->faqService->update($faq, $request->validated());

        return $this->okResponse(new FaqResource($faq));
    }

    public function destroy(Faq $faq): JsonResponse
    {
        $this->faqService->delete($faq);

        return $this->okResponse(new FaqResource($faq));
    }

    public function restore(Faq $faq): JsonResponse
    {
        $this->faqService->restore($faq);

        return $this->okResponse(new FaqResource($faq));
    }

    public function forceDelete(Faq $faq): JsonResponse
    {
        $this->faqService->destroy($faq);

        return $this->okResponse(new FaqResource($faq));
    }
}
