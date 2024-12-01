<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\PublicReportService;

class PublicReportController extends BaseController
{
    public function __construct(
        private PublicReportService $regencyReportService
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $year = request()->filter['year'] ?? now('Y');
        $quarter = request()->filter['quarter'] ?? null;
        $type = request()->filter['type'] ?? null;

        $data = $this->regencyReportService->getReportAppBySubmission($quarter, $year);

        if ($type === 'gender') {
            $data = $this->regencyReportService->getReportAppByGender($quarter, $year);
        }

        if ($type === 'regency') {
            $data = $this->regencyReportService->getReportByRegency($quarter, $year);
        }

        if ($type === 'sector') {
            $data = $this->regencyReportService->getReportBySector($quarter, $year);
        }

        if ($type === 'sector5year') {
            $data = $this->regencyReportService->getReportBySector5Year($year);
        }

        if ($type === 'achievement-realization') {
            $data = $this->regencyReportService->getReportByAchivement($quarter, $year);
        }

        unset($data['user']);
        unset($data['histories']);

        return $this->successResponse($data);
    }
}
