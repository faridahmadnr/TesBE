<?php

namespace Modules\User\Services;

use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Spatie\QueryBuilder\QueryBuilder;

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

            $user->syncRoles($data['roles'] ?? []);
            $user->syncPermissions($data['permissions'] ?? []);
        } catch (Exception $e) {
            report($e);

            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this user. Please try again.'));
        }

        event(new Registered($user));

        DB::commit();

        $user->sendEmailVerificationNotification();

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
        $userQuery = $this->model::select(['id', 'name', 'email']);
        $users = QueryBuilder::for($userQuery)
            ->allowedFields(['id', 'email'])
            ->allowedFilters(['name', 'email'])
            ->paginate(10)
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
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem registering this user. Please try again.'));
        }

        DB::commit();

        return $user;
    }

    protected function createUser(array $data = []): User
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'password' => $data['password'] ?? null,
        ]);
    }
}
