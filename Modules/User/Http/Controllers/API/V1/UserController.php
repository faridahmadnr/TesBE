<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserCollection;
use Modules\User\Transformers\UserResource;

class UserController extends BaseController
{
    /**
     * Constructs a new instance of the class.
     *
     * @param  UserService  $userService The UserService instance.
     * @return void
     */
    public function __construct(
        private UserService $userService
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Retrieves all users and returns a response with a collection of users.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return $this->okResponse(new UserCollection($users));
    }

    /**
     * Store a new user.
     *
     * @param  StoreUserRequest  $request The request object containing the validated user data.
     * @return JsonResponse The response object containing the newly created user.
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return $this->okResponse(new UserResource($user));
    }

    /**
     * Shows the user data.
     *
     * @param  User  $user The user object.
     * @return JsonResponse The JSON response containing the user data.
     */
    public function show(User $user): JsonResponse
    {
        $user->loadMissing(['roles', 'profile']);

        return $this->okResponse(new UserResource($user));
    }

    /**
     * Update a user.
     *
     * @param  UpdateUserRequest  $request the request object containing the validated data
     * @param  User  $user the user to be updated
     * @return JsonResponse the JSON response containing the updated user resource
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user = $this->userService->update($user, $request->validated());

        $user->loadMissing(['roles', 'profile']);

        return $this->okResponse(new UserResource($user));
    }

    /**
     * Deletes a user.
     *
     * @param  User  $user The user to be deleted.
     * @return JsonResponse The JSON response containing the deleted user.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userService->delete($user);

        return $this->okResponse(new UserResource($user));
    }

    /**
     * Restore a user.
     *
     * @param  User  $user The user to be restored.
     * @return JsonResponse The JSON response containing the restored user.
     */
    public function restore(User $user): JsonResponse
    {
        $this->userService->restore($user);

        return $this->okResponse(new UserResource($user));
    }

    /**
     * Deletes a user permanently from the system.
     *
     * @param  User  $user The user to be deleted.
     * @return JsonResponse The JSON response containing the deleted user.
     */
    public function forceDelete(User $user): JsonResponse
    {
        $this->userService->destroy($user);

        return $this->okResponse(new UserResource($user));
    }
}
