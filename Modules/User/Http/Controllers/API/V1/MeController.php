<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Modules\User\Transformers\UserResource;

class MeController extends BaseController
{
    public function __invoke(Request $request)
    {
        $user = $request->user('sanctum');

        if (is_null($user)) {
            throw new AuthenticationException('You are not logged in.');
        }

        $user->loadMissing(['roles', 'profile']);

        return $this->okResponse(new UserResource($user));
    }
}
