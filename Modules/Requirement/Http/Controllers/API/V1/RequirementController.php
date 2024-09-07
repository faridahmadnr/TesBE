<?php

namespace Modules\Requirement\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Requirement\Entities\Requirement;
use Modules\Requirement\Http\Requests\StoreRequirementRequest;
use Modules\Requirement\Http\Requests\UpdateRequirementRequest;
use Modules\Requirement\Services\RequirementService;
use Modules\Requirement\Transformers\RequirementCollection;
use Modules\Requirement\Transformers\RequirementResource;

class RequirementController extends BaseController
{
    public function __construct(
        private RequirementService $requirementService
    ) {
        $this->authorizeResource(Requirement::class, 'requirement');
    }

    public function index()
    {
        $requirements = $this->requirementService->getAll();

        return $this->successResponse(new RequirementCollection($requirements));
    }

    public function store(StoreRequirementRequest $request): JsonResponse
    {
        $requirement = $this->requirementService->store($request->validated());

        return $this->okResponse(new RequirementResource($requirement));
    }

    public function show(Requirement $requirement): JsonResponse
    {
        return $this->okResponse(new RequirementResource($requirement));
    }

    public function update(UpdateRequirementRequest $request, Requirement $requirement): JsonResponse
    {
        $requirement = $this->requirementService->update($requirement, $request->validated());

        return $this->okResponse(new RequirementResource($requirement));
    }

    public function destroy(Requirement $requirement): JsonResponse
    {
        $this->requirementService->delete($requirement);

        return $this->okResponse(new RequirementResource($requirement));
    }

    public function restore(Requirement $requirement): JsonResponse
    {
        $this->requirementService->restore($requirement);

        return $this->okResponse(new RequirementResource($requirement));
    }

    public function forceDelete(Requirement $requirement): JsonResponse
    {
        $this->requirementService->destroy($requirement);

        return $this->okResponse(new RequirementResource($requirement));
    }
}
