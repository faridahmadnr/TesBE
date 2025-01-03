<?php

namespace Modules\Report\Http\Controllers\API\V1\External;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Report\Entities\AchivementRealizationReport;
use Modules\Report\Services\ExternalAchivementService;
use Modules\Report\Transformers\External\ExternalAchivementRealizationCollection;
use Modules\Report\Transformers\External\ExternalAchivementRealizationResource;

class ExternalAchivementController extends BaseController
{
    public function __construct(
        private ExternalAchivementService $service
    ) {
    }

    public function index(): JsonResponse
    {
        $data = $this->service->getAll();

        return $this->successResponse(new ExternalAchivementRealizationCollection($data));
    }

    public function store(Request $request): JsonResponse
    {
        $achivementRealization = $this->service->store($request->input());

        return $this->okResponse(new ExternalAchivementRealizationResource($achivementRealization));
    }

    public function show(AchivementRealizationReport $achivementRealization): JsonResponse
    {
        $achivementRealization = $this->service->show($achivementRealization);

        return $this->okResponse(new ExternalAchivementRealizationResource($achivementRealization));
    }

    public function update(Request $request, AchivementRealizationReport $achivementRealization): JsonResponse
    {
        $achivementRealization = $this->service->update($achivementRealization, $request->input());

        return $this->okResponse(new ExternalAchivementRealizationResource($achivementRealization));
    }

    // public function destroy(AchivementRealizationReport $achivementRealization): JsonResponse
    // {
    //     $this->service->delete($achivementRealization);

    //     return $this->okResponse(new SectorReportResource($achivementRealization));
    // }

    public function restore(AchivementRealizationReport $achivementRealization): JsonResponse
    {
        $this->service->restore($achivementRealization);

        return $this->noContentResponse();
    }

    public function forceDelete(AchivementRealizationReport $achivementRealization): JsonResponse
    {
        $this->service->destroy($achivementRealization);

        return $this->noContentResponse();
    }
}
