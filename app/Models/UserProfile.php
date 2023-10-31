<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends BaseModel
{
    protected $fillable = [
        'user_id',
        'phone',
        'role_id',
        'bank_id',
        'financial_institution_umi_id',
        'photo',
        'regency_id',
        'district_id',
    ];

    /**
     * Retrieve the associated user.
     *
     * @return BelongsTo<User, UserProfile>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
