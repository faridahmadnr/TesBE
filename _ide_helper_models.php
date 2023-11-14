<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel withoutTrashed()
 */
	class BaseModel extends \Eloquent {}
}

namespace Modules\Bank\Entities{
/**
 * Modules\Bank\Entities\Bank
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string|null $code
 * @property int|null $status
 * @property string|null $reason_status
 * @property string $logo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereReasonStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withoutTrashed()
 * @mixin \Eloquent
 */
	class Bank extends \Eloquent {}
}

namespace Modules\BusinessPermit\Entities{
/**
 * Modules\BusinessPermit\Entities\BusinessPermit
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessPermit withoutTrashed()
 * @mixin \Eloquent
 */
	class BusinessPermit extends \Eloquent {}
}

namespace Modules\BusinessType\Entities{
/**
 * Modules\BusinessType\Entities\BusinessType
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessType withoutTrashed()
 * @mixin \Eloquent
 */
	class BusinessType extends \Eloquent {}
}

namespace Modules\CreditRequest\Entities{
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
 * @mixin \Eloquent
 */
	class CreditRequest extends \Eloquent {}
}

namespace Modules\CreditRequest\Entities{
/**
 * Modules\CreditRequest\Entities\CreditRequestType
 *
 * @property int $id
 * @property string $name
 * @property int $min_value
 * @property int $max_value
 * @property float $interest
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
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
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMaxValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereMinValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType withoutTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestType whereInterest($value)
 * @mixin \Eloquent
 */
	class CreditRequestType extends \Eloquent {}
}

namespace Modules\Location\Entities{
/**
 * Modules\Location\Entities\District
 *
 * @property int $id
 * @property int $regency_id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\Location\Entities\Regency $regency
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|District withoutTrashed()
 * @mixin \Eloquent
 */
	class District extends \Eloquent {}
}

namespace Modules\Location\Entities{
/**
 * Modules\Location\Entities\Province
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Province newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Province onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Province query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Province withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Province withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Location\Entities\Regency> $regencies
 * @property-read int|null $regencies_count
 * @mixin \Eloquent
 */
	class Province extends \Eloquent {}
}

namespace Modules\Location\Entities{
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Location\Entities\District> $districts
 * @property-read int|null $districts_count
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\Location\Entities\Province $province
 * @property-read \Modules\User\Entities\User|null $updater
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
 * @mixin \Eloquent
 */
	class Regency extends \Eloquent {}
}

namespace Modules\Termin\Entities{
/**
 * Modules\Termin\Entities\Termin
 *
 * @property int $id
 * @property string $name
 * @property int $value
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Termin withoutTrashed()
 * @mixin \Eloquent
 */
	class Termin extends \Eloquent {}
}

namespace Modules\Testimoni\Entities{
/**
 * Modules\Testimoni\Entities\Testimoni
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $message
 * @property string|null $image
 * @property bool $is_anonymous
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereIsAnonymous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimoni withoutTrashed()
 * @mixin \Eloquent
 */
	class Testimoni extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\Member
 *
 * @property int $id
 * @property int $user_id
 * @property string $nik
 * @property string|null $phone
 * @property string|null $second_phone
 * @property string|null $address
 * @property string $gender
 * @property string $dob
 * @property string|null $photo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Member withoutTrashed()
 * @property-read \Modules\User\Entities\User $user
 * @mixin \Eloquent
 */
	class Member extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $description
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Modules\User\Entities\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @property \Illuminate\Support\Carbon|null $password_changed_at
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Modules\User\Entities\Member|null $member
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\UserProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $phone
 * @property int $role_id
 * @property string|null $bank_id
 * @property string|null $financial_institution_umi_id
 * @property string|null $photo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereFinancialInstitutionUmiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withoutTrashed()
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\User\Entities\User|null $updater
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read Bank|null $bank
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class UserProfile extends \Eloquent {}
}

