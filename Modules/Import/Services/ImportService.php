<?php

namespace Modules\Import\Services;

use App\Services\BaseService;
use Illuminate\Support\Facades\Log;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Location\Entities\Regency;
use Modules\Report\Entities\AchivementRealizationReport;
use Modules\Report\Entities\RegencyReport;
use Modules\Report\Entities\SectorReport;

final class ImportService extends BaseService
{
    public function import(array $data)
    {
        $type = $data['type'];
        $rows = $data['data'];

        if ($type == 'sector') {
            return $this->_importSector($rows);
        }

        if ($type == 'realization') {
            return $this->_importRealization($rows);
        }

        return $this->_importSubmission($rows);
    }

    private function _importSector(array $rows)
    {
        $data = [];
        foreach ($rows as $row) {
            $businessTypeId = BusinessType::select(['id', 'name'])
                ->whereRaw('LOWER(name) = ?', strtolower(trim($row[2])))
                ->first()
                ?->id;

            if (! $businessTypeId) {
                Log::info('skipped import: '.$row[2]);

                continue;
            }

            $year = $row[0];
            $quarter = strtolower($row[1]);
            $target = $row[3];
            $realizationAmount = $row[4];

            $date = $year.'-01-01';
            if ($quarter == 'Q2') {
                $date = $year.'-04-01';
            }

            if ($quarter == 'Q3') {
                $date = $year.'-07-01';
            }

            if ($quarter == 'Q4') {
                $date = $year.'-10-01';
            }

            $data[] = [
                'business_type_id' => $businessTypeId,
                'debitor' => $target,
                'realization' => $realizationAmount,
                'date' => $date,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        SectorReport::insert($data);
        SectorReport::flushQueryCache();

        return $data;
    }

    private function _importSubmission(array $rows)
    {
        $data = [];

        $creditRequestTypes = [1, 2, 3];
        foreach ($rows as $row) {
            $regencyId = Regency::select(['id', 'name'])
                ->whereRaw('LOWER(name) = ?', strtolower(trim($row[2])))
                ->first()
                ?->id;

            $year = $row[0];
            $quarter = strtolower($row[1]);
            $submissionAmount = $row[6];
            $realizationAmount = $row[7];

            $date = $year.'-01-01';
            if ($quarter == 'Q2') {
                $date = $year.'-04-01';
            }

            if ($quarter == 'Q3') {
                $date = $year.'-07-01';
            }

            if ($quarter == 'Q4') {
                $date = $year.'-10-01';
            }

            foreach ($creditRequestTypes as $key => $creditRequestTypeId) {
                $data[] = [
                    'regency_id' => $regencyId,
                    'credit_request_type_id' => $creditRequestTypeId,
                    'target' => $submissionAmount,
                    'realization' => $realizationAmount,
                    'date' => $date,
                    'debtor' => $row[3 + $key],
                ];
            }
        }

        RegencyReport::insert($data);
        RegencyReport::flushQueryCache();

        return $data;
    }

    private function _importRealization(array $rows)
    {
        $data = [];
        foreach ($rows as $row) {
            $year = $row[0];
            $target = $row[1];
            $realization = $row[2];

            $date = $year.'-01-01';

            $data[] = [
                'target' => $target,
                'realization' => $realization,
                'date' => $date,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        AchivementRealizationReport::insert($data);
        AchivementRealizationReport::flushQueryCache();

        return $data;
    }
}
