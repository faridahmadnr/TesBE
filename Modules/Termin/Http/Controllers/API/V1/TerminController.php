<?php

namespace Modules\Termin\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Termin\Entities\Termin;
use Modules\Termin\Http\Requests\StoreTerminRequest;
use Modules\Termin\Http\Requests\UpdateTerminRequest;
use Modules\Termin\Services\TerminService;
use Modules\Termin\Transformers\TerminCollection;
use Modules\Termin\Transformers\TerminResource;

class TerminController extends BaseController
{
    public function __construct(
        private TerminService $terminService
    ) {
        $this->authorizeResource(Termin::class, 'termin');
    }

    public function index(): JsonResponse
    {
        $termins = $this->terminService->getAll();

        return $this->successResponse(new TerminCollection($termins));
    }

    public function store(StoreTerminRequest $request): JsonResponse
    {
        $termin = $this->terminService->store($request->validated());

        return $this->okResponse(new TerminResource($termin));
    }

    public function show(Termin $termin): JsonResponse
    {
        return $this->okResponse(new TerminResource($termin));
    }

    public function update(UpdateTerminRequest $request, Termin $termin): JsonResponse
    {
        $termin = $this->terminService->update($termin, $request->validated());

        return $this->okResponse(new TerminResource($termin));
    }

    public function destroy(Termin $termin): JsonResponse
    {
        $this->terminService->delete($termin);

        return $this->okResponse(new TerminResource($termin));
    }

    public function restore(Termin $termin): JsonResponse
    {
        $this->terminService->restore($termin);

        return $this->okResponse(new TerminResource($termin));
    }

    public function forceDelete(Termin $termin): JsonResponse
    {
        $this->terminService->destroy($termin);

        return $this->okResponse(new TerminResource($termin));
    }
}
