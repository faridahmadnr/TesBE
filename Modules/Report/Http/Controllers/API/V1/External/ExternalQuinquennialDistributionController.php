<?php

namespace Modules\Report\Http\Controllers\API\V1\External;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Report\Entities\QuinquennialReport;
use Modules\Report\Services\ExternalQuinquennialService;
use Modules\Report\Transformers\External\ExternalSectorResource;
use Modules\Report\Transformers\ExternalQuinquennialSectorCollection;

class ExternalQuinquennialDistributionController extends BaseController
{
    public function __construct(
        private ExternalQuinquennialService $service
    ) {
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();

        return $this->successResponse(new ExternalQuinquennialSectorCollection($data));
    }

    public function store(Request $request): JsonResponse
    {
        $sectorReport = $this->service->store($request->input());

        return $this->okResponse(new ExternalSectorResource($sectorReport));
    }

    public function show(QuinquennialReport $sectorReport): JsonResponse
    {
        $sectorReport = $this->service->show($sectorReport);

        return $this->okResponse(new ExternalSectorResource($sectorReport));
    }

    public function update(Request $request, QuinquennialReport $sectorReport): JsonResponse
    {
        $sectorReport = $this->service->update($sectorReport, $request->input());

        return $this->okResponse(new ExternalSectorResource($sectorReport));
    }

    // public function destroy(QuinquennialReport $sectorReport): JsonResponse
    // {
    //     $this->service->delete($sectorReport);

    //     return $this->okResponse(new SectorReportResource($sectorReport));
    // }

    public function restore(QuinquennialReport $sectorReport): JsonResponse
    {
        $this->service->restore($sectorReport);

        return $this->noContentResponse();
    }

    public function forceDelete(QuinquennialReport $sectorReport): JsonResponse
    {
        $this->service->destroy($sectorReport);

        return $this->noContentResponse();
    }
}
