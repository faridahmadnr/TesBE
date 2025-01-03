<?php

namespace Modules\Report\Http\Controllers\API\V1\External;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Report\Entities\SectorReport;
use Modules\Report\Services\ExternalSectorReportService;
use Modules\Report\Transformers\ExternalSectorCollection;
use Modules\Report\Transformers\SectorReportResource;

class ExternalSectorDistributionController extends BaseController
{
    public function __construct(
        private ExternalSectorReportService $service
    ) {
        $this->authorizeResource(SectorReport::class, 'sectorReport');
    }

    public function index(): JsonResponse
    {
        $sectorReports = $this->service->getAll();

        return $this->successResponse(new ExternalSectorCollection($sectorReports));
    }

    public function store(Request $request): JsonResponse
    {
        $sectorReport = $this->service->store($request->input());

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function show(SectorReport $sectorReport): JsonResponse
    {
        $sectorReport = $this->service->show($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function update(Request $request, SectorReport $sectorReport): JsonResponse
    {
        $sectorReport = $this->service->update($sectorReport, $request->input());

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function destroy(SectorReport $sectorReport): JsonResponse
    {
        $this->service->delete($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function restore(SectorReport $sectorReport): JsonResponse
    {
        $this->service->restore($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function forceDelete(SectorReport $sectorReport): JsonResponse
    {
        $this->service->destroy($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }
}
