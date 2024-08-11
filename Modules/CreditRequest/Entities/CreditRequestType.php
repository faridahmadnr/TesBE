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
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withoutTrashed()
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
            ->selectRaw('credit_request_types.name')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN 1 ELSE 0 END, 0)) AS potential')
            ->selectRaw('SUM(COALESCE(CASE WHEN '.DB::regexp('credit_requests.remark', '^[0-9]+$').' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS realization')
            ->groupBy('credit_request_types.name');

        return $baseQuery;
    }
}
