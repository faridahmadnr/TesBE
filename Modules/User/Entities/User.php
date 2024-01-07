<?php

namespace Modules\User\Entities;

use App\Enums\RolesEnum;
use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Deligoez\LaravelModelHashId\Traits\HasHashIdRouting;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\User\Notifications\VerifyEmailNotification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasHashId, HasHashIdRouting, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'password_changed_at',
        'email_verified_at',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'last_login_at',
        'email_verified_at',
        'password_changed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'password_changed_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    public function isSuperAdmin()
    {
        return $this->hasRole(RolesEnum::SUPER_ADMIN);
    }

    public function isMember()
    {
        return $this->hasRole(RolesEnum::MEMBER);
    }

    public function isAdmin()
    {
        return $this->hasRole(RolesEnum::ADMIN);
    }

    public function isAdminOJK()
    {
        return $this->hasRole(RolesEnum::ADMIN_OJK);
    }

    public function isAdminBank()
    {
        return $this->hasRole(RolesEnum::ADMIN_BANK);
    }

    public function isSupervisor()
    {
        return $this->hasRole(RolesEnum::SUPERVISOR);
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    // public function sendPasswordResetNotification($token): void
    // {
    //     $url = 'https://example.com/reset-password?token='.$token;

    //     $this->notify(new ResetPasswordNotification($url));
    // }

    /**
     * Get the user's profile.
     *
     * @return HasOne<UserProfile>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Get the user's member.
     *
     * @return HasOne<Member>
     */
    public function member(): HasOne
    {
        return $this->hasOne(Member::class);
    }
}
