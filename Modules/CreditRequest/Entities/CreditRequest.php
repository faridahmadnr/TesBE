<?php

namespace Modules\CreditRequest\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreditRequest extends BaseModel
{
    protected $fillable = [
        'registration_number',
        'member_id',
        'business_type_id',
        'business_permit_id',
	    'npwp',
        'business_place_photo',
        'address_business_place',
        'regency_id',
        'district_id',
        'village',
        'postal_code',
        'kur_type_id',
        'amount',
        'tenor',
        'bank_id',
        'status',
        'reject_message',
        'pending_message',
        'process_by',
        'accepted_plafond',
        'pic_contact',
        'is_confirmed'
    ];
}
