<?php

namespace Modules\Report\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\Report\Services\PublicReportService;

class PublicReportController extends BaseController
{
    public function __construct(
        private PublicReportService $regencyReportService
    ) {}

    public function __invoke(): JsonResponse
    {
        $year = request()->filter['year'] ?? now('Y');
        $quarter = request()->filter['quarter'] ?? null;
        $type = request()->filter['type'] ?? null;

        if ($type === 'gender') {
            $data = $this->regencyReportService->getReportAppByGender($quarter, $year);
        } elseif ($type === 'regency') {
            $data = $this->regencyReportService->getReportByRegion($quarter, $year);
        } elseif ($type === 'sector') {
            $data = $this->regencyReportService->getReportBySector($quarter, $year);
        } elseif ($type === 'sector5year') {
            $data = $this->regencyReportService->getReportBySector5Year($year);
        } elseif ($type === 'achievement-realization') {
            $data = $this->regencyReportService->getReportByAchivement($quarter, $year);
        } else {
            $data = $this->regencyReportService->getReportAppBySubmission($quarter, $year);
        }

        unset($data['user']);
        unset($data['histories']);

        return $this->successResponse($data);
    }
}
