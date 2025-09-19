<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Bank\Entities\Bank;

/**
 * Modules\User\Entities\UserProfile
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $actions
 * @property-read int|null $actions_count
 * @property-read Bank|null $bank
 * @property-read \Modules\User\Entities\User|null $creator
 * @property-read string|null $hash_id
 * @property-read string|null $hash_id_raw
 * @property-read \Modules\User\Entities\User|null $updater
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel createdBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModel updatedBy($userId)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile withoutTrashed()
 * @mixin \Eloquent
 */
class UserProfile extends BaseModel
{
    protected $fillable = [
        'user_id',
        'phone',
        'bank_id',
        'financial_institution_umi_id',
        'photo',
    ];

    /**
     * Retrieve the associated user.
     *
     * @return BelongsTo<User, UserProfile>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    /**
     * Retrieves the bank associated with this model.
     *
     * @return BelongsTo<Bank, UserProfile>
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)
            ->withTrashed();
    }
}
