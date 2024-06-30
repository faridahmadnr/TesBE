<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\SectorLendingDistributionService;
use Modules\DataVisualization\Transformers\SectorReportCollection;

class SectorLendingDistributionController extends BaseController
{

    public function __construct(
        private SectorLendingDistributionService $sectorLendingDistributionService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->sectorLendingDistributionService->getAll();

        return $this->successResponse($data);
    }

}
