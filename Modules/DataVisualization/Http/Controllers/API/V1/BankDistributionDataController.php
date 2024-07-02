<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\BankDistributionDataService;
use Modules\DataVisualization\Transformers\BankDistributionCollection;

class BankDistributionDataController extends BaseController
{

    public function __construct(
        private BankDistributionDataService $bankDistributionDataService
    ) {}

    public function index(): JsonResponse
    {

        $dataTable = new BankDistributionCollection($this->bankDistributionDataService->getAll());

        return $this->successResponse($dataTable);
    }

}
