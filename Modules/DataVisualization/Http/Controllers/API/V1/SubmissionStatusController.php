<?php

namespace Modules\DataVisualization\Http\Controllers\API\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as BaseController;
use Modules\DataVisualization\Services\SubmissionStatusService;
use Modules\DataVisualization\Transformers\SectorReportCollection;

class SubmissionStatusController extends BaseController
{

    public function __construct(
        private SubmissionStatusService $submissionStatusService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->submissionStatusService->getAll();

        return $this->successResponse($data);
    }

}
