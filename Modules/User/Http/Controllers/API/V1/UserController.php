<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserCollection;
use Modules\User\Transformers\UserResource;

class UserController extends BaseController
{
    public function __construct(
        private UserService $userService
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return $this->okResponse(new UserCollection($users));
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return $this->okResponse(new UserResource($user));
    }

    public function show(User $user)
    {
        $user->loadMissing(['roles', 'profile']);

        return $this->okResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->update($user, $request->validated());

        $user->loadMissing(['roles', 'profile']);

        return $this->okResponse(new UserResource($user));
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);

        return $this->okResponse(new UserResource($user));
    }

    public function restore(User $user)
    {
        $this->userService->restore($user);

        return $this->okResponse(new UserResource($user));
    }

    public function forceDelete(User $user)
    {
        $this->userService->destroy($user);

        return $this->okResponse(new UserResource($user));
    }
}
