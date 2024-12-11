<?php

namespace Modules\Report\Http\Controllers\API\V1\External;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Report\Entities\RegencyReport;
use Modules\Report\Services\ExternalRegencyService;
use Modules\Report\Transformers\External\ExternalRegionResource;
use Modules\Report\Transformers\ExternalRegencyCollection;

class ExternalRegencyDistributionController extends BaseController
{
    public function __construct(
        private ExternalRegencyService $service
    ) {
    }

    public function index(): JsonResponse
    {
        $regionReports = $this->service->getAll();

        return $this->successResponse(new ExternalRegencyCollection($regionReports));
    }

    public function store(Request $request): JsonResponse
    {
        $regionReport = $this->service->store($request->input());
        $regionReport->loadMissing(['regency']);

        return $this->okResponse(new ExternalRegionResource($regionReport));
    }

    public function show(RegencyReport $regionReport): JsonResponse
    {
        $regionReport->loadMissing(['regency']);
        $regionReport = $this->service->show($regionReport);

        return $this->okResponse(new ExternalRegionResource($regionReport));
    }

    public function update(Request $request, RegencyReport $regionReport): JsonResponse
    {
        $regionReport->loadMissing(['regency']);
        $regionReport = $this->service->update($regionReport, $request->input());

        return $this->okResponse(new ExternalRegionResource($regionReport));
    }

    public function destroy(RegencyReport $regionReport): JsonResponse
    {
        $this->service->delete($regionReport);

        return $this->okResponse(new ExternalRegionResource($regionReport));
    }

    public function restore(RegencyReport $regionReport): JsonResponse
    {
        $this->service->restore($regionReport);

        return $this->noContentResponse();
    }

    public function forceDelete(RegencyReport $regionReport): JsonResponse
    {
        $this->service->destroy($regionReport);

        return $this->noContentResponse();
    }
}
