<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Http\Requests\LoginRequest;

class LoginController extends BaseController
{
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }
}
