<?php

namespace Modules\BusinessType\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\BusinessType\Entities\BusinessType;
use Modules\BusinessType\Http\Requests\StoreBusinessTypeRequest;
use Modules\BusinessType\Http\Requests\UpdateBusinessTypeRequest;
use Modules\BusinessType\Services\BusinessTypeService;
use Modules\BusinessType\Transformers\BusinessTypeCollection;
use Modules\BusinessType\Transformers\BusinessTypeResource;

class BusinessTypeController extends BaseController
{
    public function __construct(
        private BusinessTypeService $businessTypeService
    ) {
        $this->authorizeResource(BusinessType::class, 'businessType');
    }

    public function index(): JsonResponse
    {
        $businessTypes = $this->businessTypeService->getAll();

        return $this->successResponse(new BusinessTypeCollection($businessTypes));
    }

    public function store(StoreBusinessTypeRequest $request): JsonResponse
    {
        $businessType = $this->businessTypeService->store($request->validated());

        return $this->okResponse(new BusinessTypeResource($businessType));
    }

    public function show(BusinessType $businessType): JsonResponse
    {
        return $this->okResponse(new BusinessTypeResource($businessType));
    }

    public function update(UpdateBusinessTypeRequest $request, BusinessType $businessType): JsonResponse
    {
        $businessType = $this->businessTypeService->update($businessType, $request->validated());

        return $this->okResponse(new BusinessTypeResource($businessType));
    }

    public function destroy(BusinessType $businessType): JsonResponse
    {
        $this->businessTypeService->delete($businessType);

        return $this->okResponse(new BusinessTypeResource($businessType));
    }

    public function restore(BusinessType $businessType): JsonResponse
    {
        $this->businessTypeService->restore($businessType);

        return $this->okResponse(new BusinessTypeResource($businessType));
    }

    public function forceDelete(BusinessType $businessType): JsonResponse
    {
        $this->businessTypeService->destroy($businessType);

        return $this->okResponse(new BusinessTypeResource($businessType));
    }
}
