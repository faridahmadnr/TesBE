<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Modules\Bank\Entities\Bank;
use Modules\BusinessPermit\Entities\BusinessPermit;
use Modules\BusinessType\Entities\BusinessType;
use Modules\Location\Entities\District;
use Modules\Location\Entities\Regency;
use Modules\Termin\Entities\Termin;
use Modules\User\Entities\User;

class CreditRequest extends BaseModel
{
    public function resolveRouteBinding($value, $field = null): ?Model
    {
        if ($field !== null) {
            return parent::resolveRouteBinding($value, $field);
        }

        return $this->whereRegistrationNumber($value)->firstOrFail();
    }

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder|Relation
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
