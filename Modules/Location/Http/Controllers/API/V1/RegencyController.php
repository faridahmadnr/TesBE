<?php

namespace Modules\Location\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Location\Entities\Regency;
use Modules\Location\Http\Requests\StoreRegencyRequest;
use Modules\Location\Http\Requests\UpdateRegencyRequest;
use Modules\Location\Services\RegencyService;
use Modules\Location\Transformers\RegencyCollection;
use Modules\Location\Transformers\RegencyResource;

class RegencyController extends BaseController
{
    public function __construct(
        private RegencyService $regencyService
    ) {
        $this->authorizeResource(Regency::class, 'regency');
    }

    /**
     * Retrieves all regencys and returns a response with a collection of regencys.
     */
    public function index(): JsonResponse
    {
        $regencys = $this->regencyService->getAll();

        return $this->okResponse(new RegencyCollection($regencys));
    }

    public function store(StoreRegencyRequest $request): JsonResponse
    {
        $regency = $this->regencyService->store($request->validated());

        return $this->okResponse(new RegencyResource($regency));
    }

    public function show(Regency $regency): JsonResponse
    {
        $regency->loadMissing(['province', 'districts']);

        return $this->okResponse(new RegencyResource($regency));
    }

    public function update(UpdateRegencyRequest $request, Regency $regency): JsonResponse
    {
        $regency = $this->regencyService->update($regency, $request->validated());

        return $this->okResponse(new RegencyResource($regency));
    }

    public function destroy(Regency $regency): JsonResponse
    {
        $this->regencyService->delete($regency);

        return $this->okResponse(new RegencyResource($regency));
    }

    public function restore(Regency $regency): JsonResponse
    {
        $this->regencyService->restore($regency);

        return $this->okResponse(new RegencyResource($regency));
    }

    public function forceDelete(Regency $regency): JsonResponse
    {
        $this->regencyService->destroy($regency);

        return $this->okResponse(new RegencyResource($regency));
    }
}
