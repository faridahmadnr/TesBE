<?php

namespace Modules\Location\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Location\Entities\District;
use Modules\Location\Http\Requests\StoreDistrictRequest;
use Modules\Location\Http\Requests\UpdateDistrictRequest;
use Modules\Location\Services\DistrictService;
use Modules\Location\Transformers\DistrictCollection;
use Modules\Location\Transformers\DistrictResource;

class DistrictController extends BaseController
{
    public function __construct(
        private DistrictService $districtService
    ) {
        $this->authorizeResource(District::class, 'district');
    }

    /**
     * Retrieves all districts and returns a response with a collection of districts.
     */
    public function index(): JsonResponse
    {
        $districts = $this->districtService->getAll();

        return $this->okResponse(new DistrictCollection($districts));
    }

    public function store(StoreDistrictRequest $request): JsonResponse
    {
        $district = $this->districtService->store($request->validated());

        return $this->okResponse(new DistrictResource($district));
    }

    public function show(District $district): JsonResponse
    {
        $district->loadMissing(['regency']);

        return $this->okResponse(new DistrictResource($district));
    }

    public function update(UpdateDistrictRequest $request, District $district): JsonResponse
    {
        $district = $this->districtService->update($district, $request->validated());

        return $this->okResponse(new DistrictResource($district));
    }

    public function destroy(District $district): JsonResponse
    {
        $this->districtService->delete($district);

        return $this->okResponse(new DistrictResource($district));
    }

    public function restore(District $district): JsonResponse
    {
        $this->districtService->restore($district);

        return $this->okResponse(new DistrictResource($district));
    }

    public function forceDelete(District $district): JsonResponse
    {
        $this->districtService->destroy($district);

        return $this->okResponse(new DistrictResource($district));
    }
}
