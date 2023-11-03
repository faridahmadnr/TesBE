<?php

namespace Modules\Location\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Location\Entities\Province;
use Modules\Location\Http\Requests\StoreProvinceRequest;
use Modules\Location\Http\Requests\UpdateProvinceRequest;
use Modules\Location\Services\ProvinceService;
use Modules\Location\Transformers\ProvinceCollection;
use Modules\Location\Transformers\ProvinceResource;

class ProvinceController extends BaseController
{
    public function __construct(
        private ProvinceService $provinceService
    ) {
        $this->authorizeResource(Province::class, 'province');
    }

    /**
     * Retrieves all provinces and returns a response with a collection of provinces.
     */
    public function index(): JsonResponse
    {
        $provinces = $this->provinceService->getAll();

        return $this->okResponse(new ProvinceCollection($provinces));
    }

    public function store(StoreProvinceRequest $request): JsonResponse
    {
        $province = $this->provinceService->store($request->validated());

        return $this->okResponse(new ProvinceResource($province));
    }

    public function show(Province $province): JsonResponse
    {
        $province->load(['regencies']);

        return $this->okResponse(new ProvinceResource($province));
    }

    public function update(UpdateProvinceRequest $request, Province $province): JsonResponse
    {
        $province = $this->provinceService->update($province, $request->validated());

        return $this->okResponse(new ProvinceResource($province));
    }

    public function destroy(Province $province): JsonResponse
    {
        $this->provinceService->delete($province);

        return $this->okResponse(new ProvinceResource($province));
    }

    public function restore(Province $province): JsonResponse
    {
        $this->provinceService->restore($province);

        return $this->okResponse(new ProvinceResource($province));
    }

    public function forceDelete(Province $province): JsonResponse
    {
        $this->provinceService->destroy($province);

        return $this->okResponse(new ProvinceResource($province));
    }
}
