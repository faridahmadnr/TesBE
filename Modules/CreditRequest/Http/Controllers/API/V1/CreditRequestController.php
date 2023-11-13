<?php

namespace Modules\CreditRequest\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\CreditRequest\Entities\CreditRequest;
use Modules\CreditRequest\Http\Requests\CreditRequestSimulationRequest;
use Modules\CreditRequest\Http\Requests\StoreCreditRequestRequest;
use Modules\CreditRequest\Http\Requests\UpdateCreditRequestRequest;
use Modules\CreditRequest\Services\CreditRequestService;
use Modules\CreditRequest\Transformers\CreditRequestCollection;
use Modules\CreditRequest\Transformers\CreditRequestResource;

class CreditRequestController extends BaseController
{
    public function __construct(
        private CreditRequestService $creditRequestService
    ) {
        $this->authorizeResource(CreditRequest::class, 'creditRequest');
    }

    public function index()
    {
        $creditRequests = $this->creditRequestService->getAll();

        return $this->successResponse(new CreditRequestCollection($creditRequests));
    }

    public function store(StoreCreditRequestRequest $request): JsonResponse
    {
        $creditRequest = $this->creditRequestService->store($request->validated());

        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function show(CreditRequest $creditRequest): JsonResponse
    {
        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function update(UpdateCreditRequestRequest $request, CreditRequest $creditRequest): JsonResponse
    {
        $creditRequest = $this->creditRequestService->update($creditRequest, $request->validated());

        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function destroy(CreditRequest $creditRequest): JsonResponse
    {
        $this->creditRequestService->delete($creditRequest);

        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function restore(CreditRequest $creditRequest): JsonResponse
    {
        $this->creditRequestService->restore($creditRequest);

        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function forceDelete(CreditRequest $creditRequest): JsonResponse
    {
        $this->creditRequestService->destroy($creditRequest);

        return $this->okResponse(new CreditRequestResource($creditRequest));
    }

    public function simulation(CreditRequestSimulationRequest $request): JsonResponse
    {
        $creditRequestSimulation = $this->creditRequestService->simulation($request->validated());

        return $this->okResponse($creditRequestSimulation);
    }
}
