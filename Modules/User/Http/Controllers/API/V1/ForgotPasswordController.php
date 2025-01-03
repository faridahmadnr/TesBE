<?php

namespace Modules\User\Http\Controllers\API\V1;

use App\Http\Controllers\Controller as BaseController;
use Modules\User\Http\Requests\ForgotPasswordRequest;
use Modules\User\Services\UserService;

class ForgotPasswordController extends BaseController
{
    public function __invoke(ForgotPasswordRequest $request, UserService $userService)
    {
        $userService->forgotPassword($request->validated());

        return $this->noContentResponse();
    }
}
