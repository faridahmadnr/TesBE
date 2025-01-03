<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\BankDistributionService;
use Modules\Report\Transformers\BankDistributionChartResource;
use Modules\Report\Transformers\BankDistributionCollection;

class BankDistributionController extends BaseController
{
    public function __construct(
        private BankDistributionService $bankDistributionService
    ) {
    }

    public function table(): JsonResponse
    {
        return $this->okResponse(new BankDistributionCollection($this->bankDistributionService->getAll()));
    }

    public function chart(): JsonResponse
    {
        return $this->okResponse(new BankDistributionChartResource($this->bankDistributionService->getChart()));
    }
}
