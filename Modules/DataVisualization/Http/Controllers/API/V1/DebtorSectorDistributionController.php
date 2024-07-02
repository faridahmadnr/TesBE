<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\DebtorSectorDistributionService;
use Modules\DataVisualization\Transformers\SectorReportCollection;

class DebtorSectorDistributionController extends BaseController
{

    public function __construct(
        private DebtorSectorDistributionService $debtorSectorDistributionService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->debtorSectorDistributionService->getAll();

        return $this->successResponse($data);
    }

}
