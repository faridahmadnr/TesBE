<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\DebtorSectorDistributionService;
use Modules\Report\Transformers\DebtorSectorDistributionCollection;

class DebtorSectorDistributionController extends BaseController
{
    public function __construct(
        private DebtorSectorDistributionService $debtorSectorDistributionService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->debtorSectorDistributionService->getAll();

        return $this->successResponse(new DebtorSectorDistributionCollection($data));
    }
}
