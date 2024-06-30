<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Location\Entities\Regency;
use Modules\Report\Entities\RegencyReport;

use Modules\Report\Http\Requests\StoreRegencyReportRequest;
use Modules\Report\Http\Requests\UpdateRegencyReportRequest;

use Modules\Report\Services\RegencyReportService;
use Modules\Report\Transformers\RegencyReportCollection;
use Modules\Report\Transformers\RegencyReportResource;

class RegencyReportController extends BaseController
{
    public function __construct(
        private RegencyReportService $regencyReportService
    ) {
        $this->authorizeResource(RegencyReport::class, 'regionReport');
    }

    public function index(): JsonResponse
    {
        $regencyReports = $this->regencyReportService->getAll();

        return $this->successResponse(new RegencyReportCollection($regencyReports));
        // return $this->successResponse($regencyReports);
    }

    public function store(StoreRegencyReportRequest $request): JsonResponse
    {
        $regencyReport = $this->regencyReportService->store($request->validated());

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }

    public function show(RegencyReport $regencyReport): JsonResponse
    {
        $regencyReport = $this->regencyReportService->show($regencyReport);

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }

    public function update(UpdateRegencyReportRequest $request, RegencyReport $regencyReport): JsonResponse
    {
        $regencyReport = $this->regencyReportService->update($regencyReport, $request->validated());

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }

    public function destroy(RegencyReport $regencyReport): JsonResponse
    {
        $this->regencyReportService->delete($regencyReport);

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }

    public function restore(RegencyReport $regencyReport): JsonResponse
    {
        $this->regencyReportService->restore($regencyReport);

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }

    public function forceDelete(RegencyReport $regencyReport): JsonResponse
    {
        $this->regencyReportService->destroy($regencyReport);

        return $this->okResponse(new RegencyReportResource($regencyReport));
    }
}
