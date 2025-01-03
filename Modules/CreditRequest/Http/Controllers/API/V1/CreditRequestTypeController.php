<?php

namespace Modules\CreditRequest\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\CreditRequest\Entities\CreditRequestType;
use Modules\CreditRequest\Http\Requests\StoreCreditRequestTypeRequest;
use Modules\CreditRequest\Http\Requests\UpdateCreditRequestTypeRequest;
use Modules\CreditRequest\Services\CreditRequestTypeService;
use Modules\CreditRequest\Transformers\CreditRequestTypeCollection;
use Modules\CreditRequest\Transformers\CreditRequestTypeResource;

class CreditRequestTypeController extends BaseController
{
    public function __construct(
        private CreditRequestTypeService $creditRequestTypeService
    ) {
        $this->authorizeResource(CreditRequestType::class, 'creditRequestType');
    }

    public function index()
    {
        $creditRequestTypes = $this->creditRequestTypeService->getAll();

        return $this->successResponse(new CreditRequestTypeCollection($creditRequestTypes));
    }

    public function store(StoreCreditRequestTypeRequest $request): JsonResponse
    {
        $creditRequestType = $this->creditRequestTypeService->store($request->validated());

        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }

    public function show(CreditRequestType $creditRequestType): JsonResponse
    {
        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }

    public function update(UpdateCreditRequestTypeRequest $request, CreditRequestType $creditRequestType): JsonResponse
    {
        $creditRequestType = $this->creditRequestTypeService->update($creditRequestType, $request->validated());

        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }

    public function destroy(CreditRequestType $creditRequestType): JsonResponse
    {
        $this->creditRequestTypeService->delete($creditRequestType);

        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }

    public function restore(CreditRequestType $creditRequestType): JsonResponse
    {
        $this->creditRequestTypeService->restore($creditRequestType);

        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }

    public function forceDelete(CreditRequestType $creditRequestType): JsonResponse
    {
        $this->creditRequestTypeService->destroy($creditRequestType);

        return $this->okResponse(new CreditRequestTypeResource($creditRequestType));
    }
}
