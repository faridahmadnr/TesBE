<?php

namespace Modules\User\Services;

use App\Enums\RolesEnum;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Bank\Entities\Bank;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Storage;

final class UserService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function register(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $user->member()->create([
                'identity_number' => $data['identity_number'],
                'phone' => $data['first_phone'] ?? null,
                'address' => $data['address'],
                'second_phone' => $data['second_phone'] ?? null,
                'gender' => $data['gender'],
                'dob' => $data['dob'],
            ]);

            $user->syncRoles([RolesEnum::MEMBER]);
        } catch (Exception $e) {
            report($e);

            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this user. Please try again.'));
        }

        event(new Registered($user));

        DB::commit();

        return $user;
    }

    public function forgotPassword(array $data = [])
    {
        $status = Password::sendResetLink($data);

        if ($status == Password::RESET_LINK_SENT) {
            return __($status);
        }

        throw new GeneralException(__($status));
    }

    public function resetPassword(array $data = [])
    {
        $data = collect($data);
        $status = Password::reset(
            $data->only('email', 'password', 'password_confirmation', 'token')
                ->toArray(),
            function ($user) use ($data) {
                $user->forceFill([
                    'password' => Hash::make($data->get('password')),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return __($status);
        }

        throw new GeneralException(__($status));
    }

    public function getAllUsers()
    {
        $userQuery = $this->model::select([
            'id',
            'name',
            'email',
            'created_at',
            'deleted_at',
            'status',
        ])
            ->with(['profile', 'roles', 'profile.bank', 'member'])
            ->withoutRole(RolesEnum::SUPER_ADMIN);

        $users = QueryBuilder::for($userQuery)
            ->defaultSort('-created_at')
            ->allowedFields(['id', 'name', 'email'])
            ->allowedFilters([
                'name',
                'email',
                AllowedFilter::callback('role', function (Builder $query, $value) {
                    $query->whereHas('roles', function (Builder $query) use ($value) {
                        $query->where('name', $value);
                    });
                }),
                AllowedFilter::trashed(),
            ])
            ->allowedSorts([
                'name',
                'email',
                'status',
                AllowedSort::field('created_at', 'createdAt'), ])
            ->paginate(request()->query('pageSize') ?? 10)
            ->appends(request()->query());

        return $users;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $user = $this->createUser([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'status' => $data['active'],
                'email_verified_at' => isset($data['email_verified']) && $data['email_verified'] === 'y'
                    ? now()
                    : null,
            ]);

            $filename = null;
            if (isset($data['photo'])) {
                /** @var UploadedFile $photo */
                $photo = $data['photo'];
                $filename = 'avatar.'.$photo->getClientOriginalExtension();
                $photo->storeAs($user->hashId, $filename, [
                    'disk' => 's3',
                ]);
            }

            $user->profile()->create([
                'phone' => $data['phone'],
                'bank_id' => isset($data['bank_id']) ? Bank::keyFromHashId($data['bank_id']) : null,
                'photo' => $filename,
            ]);

            $user->syncRoles([Role::keyFromHashId($data['role_id'])]);
            $user->syncPermissions($data['permissions'] ?? []);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this user. Please try again.'));
        }

        DB::commit();

        if (isset($data['email_verified']) && ! $data['email_verified'] && $data['send_confirmation_email']) {
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }

    public function update(User $user, array $data = [])
    {
        DB::beginTransaction();

        try {
            $isNotVerified = is_null($user->email_verified_at) && isset($data['email_verified']) && $data['email_verified'] === 'y';
            $user->fill($this->createUserData([
                'name' => $data['name'],
                'email' => $data['email'],
                'email_verified_at' => $isNotVerified
                    ? now()
                    : $user->email_verified_at,
            ]));

            if (isset($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            $filename = $user->profile->photo;
            if (isset($data['photo'])) {
                /** @var UploadedFile $photo */
                $photo = $data['photo'];
                $filename = 'avatar.'.$photo->getClientOriginalExtension();
                $photo->storeAs($user->hashId, $filename, [
                    'disk' => 's3',
                ]);
            }

            $user->profile()->update([
                'phone' => $data['phone'],
                'bank_id' => isset($data['bank_id']) ? Bank::keyFromHashId($data['bank_id']) : $user->profile->bank_id,
                'photo' => $filename,
            ]);

            $user->syncRoles([Role::keyFromHashId($data['role_id'])]);
            $user->syncPermissions($data['permissions'] ?? []);
        } catch (\Throwable $th) {
            report($th);
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this user. Please try again.'));
        }

        DB::commit();

        if (isset($data['email_verified']) && ! $data['email_verified'] && $data['send_confirmation_email'] && ! $user->email_verified_at) {
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }

    public function delete(User $user): User
    {
        if ($user->id === auth()->id()) {
            throw new GeneralException(__('You can not delete yourself.'));
        }

        if ($this->deleteById($user->id)) {
            // event(new UserDeleted($user));

            return $user;
        }

        throw new GeneralException('There was a problem deleting this user. Please try again.');
    }

    public function restore(User $user): User
    {
        if ($user->restore()) {
            // event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('There was a problem restoring this user. Please try again.'));
    }

    public function destroy(User $user): bool
    {
        if (
            ! $user->isSuperAdmin()
            && $user->forceDelete()) {

            if (! is_null($user->profile) && $user->profile->photo) {
                Storage::disk('s3')->delete($user->hashId.'/'.$user->profile->photo);
            }
            // event(new UserDestroyed($user));

            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this user. Please try again.'));
    }

    public function mark(User $user, $status): User
    {
        if ($status === 0 && auth()->id() === $user->id) {
            throw new GeneralException(__('You can not do that to yourself.'));
        }

        if ($status === 0 && $user->isSuperAdmin()) {
            throw new GeneralException(__('You can not deactivate the administrator account.'));
        }

        $user->active = $status;

        if ($user->save()) {
            // event(new UserStatusChanged($user, $status));

            return $user;
        }

        throw new GeneralException(__('There was a problem updating this user. Please try again.'));
    }

    protected function createUserData(array $data = []): array
    {
        $result = [
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
            'status' => ! isset($data['status']) ? false : $data['status'] === 'y',
            'email_verified_at' => $data['email_verified_at'] ?? null,
        ];

        return array_filter($result, function ($value) {
            return $value !== null;
        });
    }

    protected function createUser(array $data = []): User
    {
        return $this->model::create($this->createUserData($data));
    }
}
