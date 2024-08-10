<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\DataVisualization\Enums\QuartersEnum;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;

/**
 * Modules\CreditRequest\Entities\CreditRequest
 *
 * @property int $id
 * @property string $registration_number
 * @property int|null $user_id
 * @property int|null $business_type_id
 * @property int|null $business_permit_id
 * @property string|null $business_tin NPWP (Taxpayer Identification Number)
 * @property string|null $image
 * @property string $business_address
 * @property int|null $business_regency_id
 * @property int|null $business_district_id
 * @property string $village
 * @property string $postal_code
 * @property int|null $credit_request_type_id
 * @property int|null $termin_id
 * @property int|null $bank_id
 * @property int $amount
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $remark
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read Bank|null $bank
 * @property-read BusinessPermit|null $businessPermit
 * @property-read BusinessType|null $businessType
 * @property-read User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequestType|null $creditRequestType
 * @property-read District|null $district
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\CreditRequest\Entities\CreditRequestHistory> $histories
 * @property-read int|null $histories_count
 * @property-read Regency|null $regency
 * @property-read Termin|null $termin
 * @property-read User|null $updater
 * @property-read User|null $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static Builder|CreditRequest newModelQuery()
 * @method static Builder|CreditRequest newQuery()
 * @method static Builder|CreditRequest onlyTrashed()
 * @method static Builder|CreditRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static Builder|CreditRequest whereAmount($value)
 * @method static Builder|CreditRequest whereBankId($value)
 * @method static Builder|CreditRequest whereBusinessAddress($value)
 * @method static Builder|CreditRequest whereBusinessDistrictId($value)
 * @method static Builder|CreditRequest whereBusinessPermitId($value)
 * @method static Builder|CreditRequest whereBusinessRegencyId($value)
 * @method static Builder|CreditRequest whereBusinessTin($value)
 * @method static Builder|CreditRequest whereBusinessTypeId($value)
 * @method static Builder|CreditRequest whereCreatedAt($value)
 * @method static Builder|CreditRequest whereCreatedBy($value)
 * @method static Builder|CreditRequest whereCreditRequestTypeId($value)
 * @method static Builder|CreditRequest whereDeletedAt($value)
 * @method static Builder|CreditRequest whereDeletedBy($value)
 * @method static Builder|CreditRequest whereId($value)
 * @method static Builder|CreditRequest whereImage($value)
 * @method static Builder|CreditRequest wherePostalCode($value)
 * @method static Builder|CreditRequest whereRegistrationNumber($value)
 * @method static Builder|CreditRequest whereRemark($value)
 * @method static Builder|CreditRequest whereStatus($value)
 * @method static Builder|CreditRequest whereTerminId($value)
 * @method static Builder|CreditRequest whereUpdatedAt($value)
 * @method static Builder|CreditRequest whereUpdatedBy($value)
 * @method static Builder|CreditRequest whereUserId($value)
 * @method static Builder|CreditRequest whereVillage($value)
 * @method static Builder|CreditRequest withTrashed()
 * @method static Builder|CreditRequest withoutTrashed()
 *
 * @mixin \Eloquent
 */
final class CreditRequest extends BaseModel
{
    protected $with = ['user', 'user.member', 'histories'];

    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field !== null) {
            return parent::resolveRouteBinding($value, $field);
        }

        return $this->whereRegistrationNumber($value)->firstOrFail();
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder
    {
        return $query->whereRegistrationNumber($field ?? $this->getRouteKeyName(), $value);
    }

    /**
     * Get the value of the model's route key.
     */
    public function getRouteKey(): string
    {
        return 'registration_number';
    }

    protected $fillable = [
        'registration_number',
        'user_id',
        'business_type_id',
        'business_permit_id',
        'business_tin',
        'image',
        'business_address',
        'business_regency_id',
        'business_district_id',
        'village',
        'postal_code',
        'credit_request_type_id',
        'amount',
        'termin_id',
        'bank_id',
        'status',
        'remark',

        'reject_message',
        'pending_message',
        'process_by',
        'accepted_plafond',
        'pic_contact',
        'is_confirmed',
    ];

    /**
     * Retrieves the related Regency model.
     *
     * @return BelongsTo<Regency, CreditRequest> The related Regency model.
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class, 'business_regency_id');
    }

    /**
     * Retrieves the related District model.
     *
     * @return BelongsTo<District, CreditRequest> The related Regency model.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'business_district_id');
    }

    /**
     * Retrieves the related Termin model.
     *
     * @return BelongsTo<Termin, CreditRequest> The related Regency model.
     */
    public function termin(): BelongsTo
    {
        return $this->belongsTo(Termin::class);
    }

    /**
     * Retrieves the related User model.
     *
     * @return BelongsTo<User, CreditRequest> The related Regency model.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieves the related CreditRequestType model.
     *
     * @return BelongsTo<CreditRequestType, CreditRequest> The related Regency model.
     */
    public function creditRequestType(): BelongsTo
    {
        return $this->belongsTo(CreditRequestType::class);
    }

    /**
     * Retrieves the related BusinessPermit model.
     *
     * @return BelongsTo<BusinessPermit, CreditRequest> The related Regency model.
     */
    public function businessPermit(): BelongsTo
    {
        return $this->belongsTo(BusinessPermit::class);
    }

    /**
     * Retrieves the related BusinessType model.
     *
     * @return BelongsTo<BusinessType, CreditRequest> The related Regency model.
     */
    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }

    /**
     * Retrieves the related Bank model.
     *
     * @return BelongsTo<Bank, CreditRequest> The related Regency model.
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * Retrieves the related CreditRequestHistory model.
     *
     * @return HasMany<CreditRequestHistory> The related history model.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(CreditRequestHistory::class)->orderBy('created_at', 'desc');
    }

    public function scopeYear(Builder $query, $year = null)
    {
        $query->whereYear('credit_requests.created_at', $year ?? date('Y'));
    }

    public function scopeQuarter(Builder $query, $quarter = null)
    {
        [$startMonth, $endMonth] = QuartersEnum::getQuarterMonthsValue(strtoupper($quarter));
        $query->whereMonth('credit_requests.created_at', '<=', $endMonth)
            ->whereMonth('credit_requests.created_at', '>=', $startMonth);
    }
}
