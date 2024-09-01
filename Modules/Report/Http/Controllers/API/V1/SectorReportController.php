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

    public function show(SectorReport $sector): JsonResponse
    {
        $sectorReport = $this->sectorReportService->show($sector);

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function update(UpdateSectorReportRequest $request, SectorReport $sector): JsonResponse
    {
        $sectorReport = $this->sectorReportService->update($sector, $request->validated());

        return $this->okResponse(new SectorReportResource($sectorReport));
    }

    public function destroy(SectorReport $sector): JsonResponse
    {
        $this->sectorReportService->delete($sector);

        return $this->okResponse(new SectorReportResource($sector));
    }

    public function restore(SectorReport $sector): JsonResponse
    {
        $this->sectorReportService->restore($sector);

        return $this->okResponse(new SectorReportResource($sector));
    }

    public function forceDelete(SectorReport $sector): JsonResponse
    {
        $this->sectorReportService->destroy($sector);

        return $this->okResponse(new SectorReportResource($sector));
    }
}
