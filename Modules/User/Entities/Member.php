<?php

namespace Modules\User\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
