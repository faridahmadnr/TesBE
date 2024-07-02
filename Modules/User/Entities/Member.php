<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property-read string|null $hash_id_raw
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
 * @mixin \Eloquent
 */
class Member extends BaseModel
{
    protected $fillable = [
        'identity_number',
        'phone',
        'address',
        'second_phone',
        'gender',
        'dob',
        'photo',
    ];

    protected $casts = [
        'identity_number' => 'encrypted',
        'phone' => 'encrypted',
        'address' => 'encrypted',
        'second_phone' => 'encrypted',
        'dob' => 'date',
    ];

    /**
     * Retrieve the associated user.
     *
     * @return BelongsTo<User, Member> The associated user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
