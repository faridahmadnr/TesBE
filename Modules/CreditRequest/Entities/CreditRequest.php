<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;

/**
 * Modules\CreditRequest\Entities\CreditRequest
 *
 * @property int $id
 * @property string $registration_number
 * @property int $user_id
 * @property int $business_type_id
 * @property int $business_permit_id
 * @property string|null $business_tin NPWP (Taxpayer Identification Number)
 * @property string|null $image
 * @property string $business_address
 * @property int $business_regency_id
 * @property int $business_district_id
 * @property string $village
 * @property string $postal_code
 * @property int $credit_request_type_id
 * @property int $termin_id
 * @property int $bank_id
 * @property int $amount
 * @property int $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Bank $bank
 * @property-read BusinessPermit $businessPermit
 * @property-read BusinessType $businessType
 * @property-read User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequestType $creditRequestType
 * @property-read District $district
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read Regency $regency
 * @property-read Termin $termin
 * @property-read User|null $updater
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessPermitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessTin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereBusinessTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereCreditRequestTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereTerminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereVillage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest withoutTrashed()
 *
 * @mixin \Eloquent
 */
class CreditRequest extends BaseModel
{
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
}
