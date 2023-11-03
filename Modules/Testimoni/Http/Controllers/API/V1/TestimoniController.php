<?php

namespace Modules\Testimoni\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Testimoni\Entities\Testimoni;
use Modules\Testimoni\Http\Requests\StoreTestimoniRequest;
use Modules\Testimoni\Http\Requests\UpdateTestimoniRequest;
use Modules\Testimoni\Services\TestimoniService;
use Modules\Testimoni\Transformers\TestimoniCollection;
use Modules\Testimoni\Transformers\TestimoniResource;

class TestimoniController extends BaseController
{
    public function __construct(
        private TestimoniService $testimoniService
    ) {
        $this->authorizeResource(Testimoni::class, 'testimonial');
    }

    public function index()
    {
        $testimonials = $this->testimoniService->getAll();

        return $this->successResponse(new TestimoniCollection($testimonials));
    }

    public function store(StoreTestimoniRequest $request): JsonResponse
    {
        $testimonial = $this->testimoniService->store($request->validated());

        return $this->okResponse(new TestimoniResource($testimonial));
    }

    public function show(Testimoni $testimonial): JsonResponse
    {
        return $this->okResponse(new TestimoniResource($testimonial));
    }

    public function update(UpdateTestimoniRequest $request, Testimoni $testimonial): JsonResponse
    {
        $testimonial = $this->testimoniService->update($testimonial, $request->validated());

        return $this->okResponse(new TestimoniResource($testimonial));
    }

    public function destroy(Testimoni $testimonial): JsonResponse
    {
        $this->testimoniService->delete($testimonial);

        return $this->okResponse(new TestimoniResource($testimonial));
    }

    public function restore(Testimoni $testimonial): JsonResponse
    {
        $this->testimoniService->restore($testimonial);

        return $this->okResponse(new TestimoniResource($testimonial));
    }

    public function forceDelete(Testimoni $testimonial): JsonResponse
    {
        $this->testimoniService->destroy($testimonial);

        return $this->okResponse(new TestimoniResource($testimonial));
    }
}
