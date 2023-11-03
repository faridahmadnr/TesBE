<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Services\UserService;
use Modules\User\Transformers\UserResource;

class RegisterController extends BaseController
{
    public function __invoke(RegisterRequest $request, UserService $userService)
    {
        $user = $userService->register($request->validated());

        return $this->successResponse(new UserResource($user));
    }
}
