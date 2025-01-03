<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Transformers\UserResource;

class LoginController extends BaseController
{
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user('sanctum');

        activity('login')->causedBy($user)->log("User {$user->email} logged in");

        $user->loadMissing(['roles', 'profile', 'permissions']);

        return $this->okResponse(new UserResource($user));
    }
}
