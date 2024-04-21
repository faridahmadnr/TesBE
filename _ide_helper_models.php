<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Modules\Bank\Entities{
/**
 * Modules\Bank\Entities\Bank
 *
 * @property int $id
 * @property string $name
 * @property string|null $link
 * @property string|null $code
 * @property bool|null $status
 * @property string|null $reason_status
 * @property string|null $logo
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Modules\BusinessType\Database\factories\BusinessTypeFactory factory($count = null, $state = [])
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
 */
	class BusinessType extends \Eloquent {}
}

namespace Modules\CreditRequest\Entities{
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
 * @property-read \Modules\Bank\Entities\Bank|null $bank
 * @property-read \Modules\BusinessPermit\Entities\BusinessPermit|null $businessPermit
 * @property-read \Modules\BusinessType\Entities\BusinessType|null $businessType
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequestType|null $creditRequestType
 * @property-read \Modules\Location\Entities\District|null $district
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\CreditRequest\Entities\CreditRequestHistory> $histories
 * @property-read int|null $histories_count
 * @property-read \Modules\Location\Entities\Regency|null $regency
 * @property-read \Modules\Termin\Entities\Termin|null $termin
 * @property-read \Modules\User\Entities\User|null $updater
 * @property-read \Modules\User\Entities\User|null $user
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
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereTerminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest whereVillage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequest withoutTrashed()
 */
	final class CreditRequest extends \Eloquent {}
}

namespace Modules\CreditRequest\Entities{
/**
 * Modules\CreditRequest\Entities\CreditRequestHistory
 *
 * @property int $id
 * @property int $credit_request_id
 * @property int $status
 * @property string $description
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read \Modules\CreditRequest\Entities\CreditRequest $creditRequest
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereCreditRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditRequestHistory withoutTrashed()
 */
	class CreditRequestHistory extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Location\Entities\Regency> $regencies
 * @property-read int|null $regencies_count
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
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
 */
	class Regency extends \Eloquent {}
}

namespace Modules\News\Entities{
/**
 * Modules\News\Entities\News
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property array $content
 * @property string|null $summary
 * @property string|null $featured_image
 * @property bool $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\NewsCategory> $categories
 * @property-read int|null $categories_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|News withoutTrashed()
 */
	class News extends \Eloquent {}
}

namespace Modules\News\Entities{
/**
 * Modules\News\Entities\NewsCategory
 *
 * @property int $id
 * @property string $name
 * @property string $slug
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
 * @property-read string $hash_id_raw
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\News\Entities\News> $news
 * @property-read int|null $news_count
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory withoutTrashed()
 */
	class NewsCategory extends \Eloquent {}
}

namespace Modules\Report\Entities{
/**
 * Modules\Report\Entities\SectorReport
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\BusinessType\Entities\BusinessType|null $businessType
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read mixed $month
 * @property-read mixed $year
 * @property-read \Modules\User\Entities\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SectorReport withoutTrashed()
 */
	class SectorReport extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
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
 */
	class Testimoni extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\Member
 *
 * @property int $id
 * @property int $user_id
 * @property mixed $identity_number
 * @property mixed|null $phone
 * @property mixed|null $second_phone
 * @property mixed|null $address
 * @property string $gender
 * @property \Illuminate\Support\Carbon $dob
 * @property string|null $photo
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
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @property-read \Modules\User\Entities\User $user
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
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSecondPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Member withoutTrashed()
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
 * @property-read \Modules\User\Entities\?string $hash_id_raw
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
 * @property \Illuminate\Support\Carbon|null $password_changed_at
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property int $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string|null $hash_id
 * @property-read \Modules\User\Entities\?string $hash_id_raw
 * @property-read \Modules\User\Entities\Member|null $member
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Modules\User\Entities\UserProfile|null $profile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
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
 * @property int|null $bank_id
 * @property string|null $photo
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read \Modules\Bank\Entities\Bank|null $bank
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
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
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withoutTrashed()
 */
	class UserProfile extends \Eloquent {}
}

