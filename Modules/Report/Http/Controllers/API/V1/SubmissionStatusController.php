<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\SubmissionStatusService;
use Modules\Report\Transformers\SubmissionStatusCollection;

class SubmissionStatusController extends BaseController
{
    public function __construct(
        private SubmissionStatusService $submissionStatusService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $type = request()->filter['type'] ?? null;
        $data = $this->submissionStatusService->getSubmissionStatus($type);

        if ($type === 'stats' || $type === 'kurType') {
            return $this->successResponse($data);
        }

        if ($type === 'gender') {
            unset($data['user']);
            unset($data['histories']);

            return $this->successResponse($data);
        }

        return $this->successResponse(new SubmissionStatusCollection($data));
    }
}
