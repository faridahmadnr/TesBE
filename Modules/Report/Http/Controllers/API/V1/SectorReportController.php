<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;

use Modules\Report\Entities\SectorReport;

use Modules\Report\Http\Requests\StoreSectorReportRequest;
use Modules\Report\Http\Requests\UpdateSectorReportRequest;

use Modules\Report\Services\SectorReportService;
use Modules\Report\Transformers\SectorReportCollection;
use Modules\Report\Transformers\SectorReportResource;

class SectorReportController extends BaseController
{
    public function __construct(
        private SectorReportService $sectorReportService
    ) {
        $this->authorizeResource(SectorReport::class, 'sectorReport');
    }

    public function index(): JsonResponse
    {
        $sectorReports = $this->sectorReportService->getAll();

        return $this->successResponse(new SectorReportCollection($sectorReports));
    }

    public function store(StoreSectorReportRequest $request): JsonResponse
    {
        $sectorReport = $this->sectorReportService->store($request->validated());

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function show(SectorReport $sectorReport): JsonResponse
    {
        $sectorReport = $this->sectorReportService->show($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function update(UpdateSectorReportRequest $request, SectorReport $sectorReport): JsonResponse
    {
        $termin = $this->sectorReportService->update($sectorReport, $request->validated());

        return $this->okResponse(new SectorReportResource($termin));
    }

    public function destroy(SectorReport $sectorReport): JsonResponse
    {
        $this->sectorReportService->delete($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function restore(SectorReport $sectorReport): JsonResponse
    {
        $this->sectorReportService->restore($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function forceDelete(SectorReport $sectorReport): JsonResponse
    {
        $this->sectorReportService->destroy($sectorReport);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }
}
