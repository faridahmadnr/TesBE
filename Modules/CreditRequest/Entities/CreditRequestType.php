<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Report\Enums\QuartersEnum;

/**
 * Modules\CreditRequest\Entities\CreditRequestType
 *
 * @property int $id
 * @property string $name
 * @property float $interest
 * @property int $min_value
 * @property int $max_value
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static Builder|CreditRequestType newModelQuery()
 * @method static Builder|CreditRequestType newQuery()
 * @method static Builder|CreditRequestType onlyTrashed()
 * @method static Builder|CreditRequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static Builder|CreditRequestType whereCreatedAt($value)
 * @method static Builder|CreditRequestType whereCreatedBy($value)
 * @method static Builder|CreditRequestType whereDeletedAt($value)
 * @method static Builder|CreditRequestType whereDeletedBy($value)
 * @method static Builder|CreditRequestType whereId($value)
 * @method static Builder|CreditRequestType whereInterest($value)
 * @method static Builder|CreditRequestType whereMaxValue($value)
 * @method static Builder|CreditRequestType whereMinValue($value)
 * @method static Builder|CreditRequestType whereName($value)
 * @method static Builder|CreditRequestType whereUpdatedAt($value)
 * @method static Builder|CreditRequestType whereUpdatedBy($value)
 * @method static Builder|CreditRequestType withSubmissionStatus($year = null, $quarter = null)
 * @method static Builder|CreditRequestType withTrashed()
 * @method static Builder|CreditRequestType withoutTrashed()
 *
 * @mixin \Eloquent
 */
class CreditRequestType extends BaseModel
{
    protected $fillable = [
        'name',
        'min_value',
        'max_value',
        'interest',
    ];

    public function scopeWithSubmissionStatus(Builder $query, $year = null, $quarter = null)
    {
        $baseQuery = $query
            ->leftJoin('credit_requests', function ($join) use ($year, $quarter) {
                $join->on('credit_request_types.id', '=', 'credit_requests.credit_request_type_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('credit_requests.created_at', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                    });
            })
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' THEN 1 ELSE 0 END, 0)) AS debitor')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status != '.CreditRequestStatusEnum::APPROVED->value.' AND '.DB::regexp('credit_requests.remark', '^[0-9]+$').' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS submission')
            ->selectRaw('credit_request_types.name as name')
            ->groupBy('credit_request_types.name');

        return $baseQuery;
    }
}
