<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\BankDistributionService;
use Modules\DataVisualization\Transformers\BankDistributionCollection;

class BankDistributionController extends BaseController
{

    public function __construct(
        private BankDistributionService $bankDistributionService
    ) {}

    public function index(): JsonResponse
    {
        $dataChart = $this->bankDistributionService->getAll();

        return $this->successResponse($dataChart);
    }

}
