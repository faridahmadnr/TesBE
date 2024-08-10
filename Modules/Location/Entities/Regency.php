<?php

namespace Modules\Location\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\CreditRequest\Enums\CreditRequestStatusEnum;
use Modules\Report\Enums\QuartersEnum;

/**
 * Modules\Location\Entities\Regency
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Location\Entities\District> $districts
 * @property-read int|null $districts_count
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\Location\Entities\Province $province
 * @property-read \Modules\User\Entities\User|null $updater
 * @property-read int $submission_amount
 * @property-read int $realization_amount
 * @property-read int $debtor_value
 * @property-read int $total_target
 * @property-read int $total_realization
 * @property-read int $total_debitor
 * @property-read int $total_target
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Regency withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Regency withoutTrashed()
 *
 * @mixin \Eloquent
 */
class Regency extends BaseModel
{
    protected $fillable = [
        'province_id',
        'name',
    ];

    /**
     * Retrieves the province associated with this model.
     *
     * @return BelongsTo<Province, Regency> The province relationship.
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Retrieves the districts associated with this model.
     *
     * @return HasMany<District> The hasMany relation.
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function scopeWithSubmissionStatus(Builder $query, $creditRequestTypes = null, $year = null, $quarter = null)
    {
        $baseQuery = $query
            ->leftJoin('credit_requests', function ($join) use ($year, $quarter) {
                $join->on('regencies.id', '=', 'credit_requests.business_regency_id')
                    ->when($year, function ($query) use ($year) {
                        $query->whereYear('credit_requests.created_at', $year);
                    })
                    ->when(! is_null($quarter) && $quarter !== 'all', function ($query) use ($quarter) {
                        [$quarter] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
                        $query->whereRaw('EXTRACT(QUARTER FROM credit_requests.created_at) = ?', [$quarter]);
                    });
            })
            ->selectRaw('LOWER(regencies.name) as name')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN 1 ELSE 0 END, 0)) AS potential')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.status = '.CreditRequestStatusEnum::DRAFT->value.' THEN credit_requests.amount ELSE 0 END, 0)) AS submission')
            ->selectRaw('SUM(COALESCE(CASE WHEN credit_requests.remark ~ \'^[0-9]+$\' THEN CAST(credit_requests.remark AS decimal) ELSE 0 END, 0)) AS realization')
            ->groupBy('regencies.name');

        if ($creditRequestTypes) {
            foreach ($creditRequestTypes as $creditRequestTypeName => $creditRequestTypeId) {
                $baseQuery->selectRaw(
                    'SUM(COALESCE(CASE WHEN credit_requests.credit_request_type_id = '
                    .$creditRequestTypeId
                    .' THEN 1 ELSE 0 END, 0)) AS '
                    .\Str::camel(str_replace('kur', '', strtolower($creditRequestTypeName)))
                );
            }
        }

        return $baseQuery;
    }
}
