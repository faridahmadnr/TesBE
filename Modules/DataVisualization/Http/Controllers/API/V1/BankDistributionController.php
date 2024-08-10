<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\DataVisualization\Services\BankDistributionService;

class BankDistributionController extends BaseController
{
    public function __construct(
        private BankDistributionService $bankDistributionService
    ) {
    }

    public function index(): JsonResponse
    {
        $dataChart = $this->bankDistributionService->getAll();

        return $this->successResponse($dataChart);
    }
}
