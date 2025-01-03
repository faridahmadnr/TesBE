<?php

namespace Modules\BusinessPermit\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessPermit\Http\Requests\StoreBusinessPermitRequest;
use Modules\BusinessPermit\Http\Requests\UpdateBusinessPermitRequest;
use Modules\BusinessPermit\Services\BusinessPermitService;
use Modules\BusinessPermit\Transformers\BusinessPermitCollection;
use Modules\BusinessPermit\Transformers\BusinessPermitResource;

class BusinessPermitController extends BaseController
{
    public function __construct(
        private BusinessPermitService $businessPermitService
    ) {
        $this->authorizeResource(BusinessPermit::class, 'businessPermit');
    }

    public function index()
    {
        $businessPermits = $this->businessPermitService->getAll();

        return $this->successResponse(new BusinessPermitCollection($businessPermits));
    }

    public function store(StoreBusinessPermitRequest $request): JsonResponse
    {
        $businessPermit = $this->businessPermitService->store($request->validated());

        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }

    public function show(BusinessPermit $businessPermit): JsonResponse
    {
        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }

    public function update(UpdateBusinessPermitRequest $request, BusinessPermit $businessPermit): JsonResponse
    {
        $businessPermit = $this->businessPermitService->update($businessPermit, $request->validated());

        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }

    public function destroy(BusinessPermit $businessPermit): JsonResponse
    {
        $this->businessPermitService->delete($businessPermit);

        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }

    public function restore(BusinessPermit $businessPermit): JsonResponse
    {
        $this->businessPermitService->restore($businessPermit);

        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }

    public function forceDelete(BusinessPermit $businessPermit): JsonResponse
    {
        $this->businessPermitService->destroy($businessPermit);

        return $this->okResponse(new BusinessPermitResource($businessPermit));
    }
}
