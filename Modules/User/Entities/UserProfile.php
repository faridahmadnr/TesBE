<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Bank\Entities\Bank;

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
