<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\RegencyDistributionService;


class RegencyDistributionController extends BaseController
{

    public function __construct(
        private RegencyDistributionService $regencyDistributionService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->regencyDistributionService->getAll();

        return $this->successResponse($data);
    }

}
