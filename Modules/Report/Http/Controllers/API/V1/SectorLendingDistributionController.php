<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\SectorLendingDistributionService;
use Modules\Report\Transformers\SectorLendingDistributionCollection;

class SectorLendingDistributionController extends BaseController
{
    public function __construct(
        private SectorLendingDistributionService $sectorLendingDistributionService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->sectorLendingDistributionService->getAll();

        return $this->successResponse(new SectorLendingDistributionCollection($data));
    }
}
