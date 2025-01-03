<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\RegencyDistributionService;

class RegencyDistributionController extends BaseController
{
    public function __construct(
        private RegencyDistributionService $regencyDistributionService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $data = $this->regencyDistributionService->getAll();

        return $this->successResponse($data);
    }
}
